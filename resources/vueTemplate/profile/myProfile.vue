<template>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                            <div class="profile-avatar">
                                <img :src="profileImageSrc" alt="Profile Picture" @error="onImgError" @click="openModal" class="clickable-avatar" />
                            </div>
                <div class="profile-info">
                    <h1>My Profile</h1>
                    <div class="info-row">
                        <label>Name:</label>
                        <span>{{ userData.userData.name }}</span>
                    </div>
                    <div class="info-row">
                        <label>ID:</label>
                        <span>{{ userData.userData.id }}</span>
                    </div>
                    <div class="info-row">
                        <label>Email:</label>
                        <span>{{ userData.userData.email }}</span>
                    </div>
                    <button class="logout-btn" type="button" @click="logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
<hr></hr>
        <Profile_nav></Profile_nav>
        <RouterView></RouterView>

        <!-- Profile picture upload modal -->
        <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
            <div class="modal-card">
                <h3>Update Profile Picture</h3>
                <div class="preview">
                    <img :src="previewSrc || profileImageSrc" alt="Preview" @error="onImgError" />
                </div>
                <input type="file" accept="image/*" @change="onFileChange" />
                <div v-if="isUploading" class="modal-loader">
                    <span class="loader"></span>
                    <span>Uploading...</span>
                </div>
                <div class="modal-actions">
                    <button class="btn" @click="uploadPicture" :disabled="!selectedFile || isUploading">Update</button>
                    <button class="btn secondary" @click="closeModal" :disabled="isUploading">Cancel</button>
                </div>
                <p v-if="uploadMessage" class="upload-message">{{ uploadMessage }}</p>
            </div>
        </div>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';
import { ref, computed } from 'vue';
import { useUser } from '../../Store/user';
import Profile_nav from '../nav/profile_nav.vue';

export default {
    components: {Profile_nav},
    setup() {
        const userData = useUser();
        const showModal = ref(false);
        const selectedFile = ref(null);
        const previewSrc = ref('');
        const uploadMessage = ref('');
        const isUploading = ref(false);
        return { userData, showModal, selectedFile, previewSrc, uploadMessage, isUploading }
    },

    computed: {
        profileImageSrc() {
            const pic = this.userData && this.userData.userData && this.userData.userData.Profile_Picture
            if (!pic) return '/storage/Default.png'
            if (/^https?:\/\//.test(pic)) return pic
            const normalized = pic.replace(/^\//, '').replace(/^image\//, 'storage/')
            return window.location.origin + '/' + normalized
        }
    },

    methods: {
        logout() {
            this.userData.logout()
            this.$router.push("/login")
        },

        openModal(){
            this.uploadMessage = '';
            this.previewSrc = '';
            this.selectedFile = null;
            this.showModal = true;
        },

        closeModal(){
            this.showModal = false;
        },

        onFileChange(e){
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            // basic client-side validation
            if (!file.type.startsWith('image/')){
                this.uploadMessage = 'Please select an image file.';
                return;
            }
            this.selectedFile = file;
            const reader = new FileReader();
            reader.onload = (ev) => { this.previewSrc = ev.target.result; };
            reader.readAsDataURL(file);
        },

        async uploadPicture(){
            if (!this.selectedFile){
                this.uploadMessage = 'No file selected.';
                return;
            }
            this.isUploading = true;
            const formData = new FormData();
            formData.append('code', this.userData.userData.code || this.userData.userData.id || '');
            formData.append('Profile_Picture', this.selectedFile);
            try{
                const resp = await axios.post('/api/uploadprofilepicture', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                if (resp && resp.data && resp.data.path){
                    const pathWithBust = resp.data.path + '?v=' + Date.now();
                    if (typeof this.userData.$patch === 'function'){
                        this.userData.$patch(state => {
                            if (!state.userData) state.userData = {};
                            state.userData.Profile_Picture = pathWithBust;
                        });
                    } else {
                        this.userData.userData.Profile_Picture = pathWithBust;
                    }
                    this.uploadMessage = 'Upload successful.';
                    setTimeout(() => { this.closeModal(); this.isUploading = false; }, 800);
                } else {
                    this.uploadMessage = resp.data.message || 'Upload completed.';
                    this.isUploading = false;
                }
            }catch(err){
                console.error(err);
                this.uploadMessage = err.response && err.response.data && err.response.data.message ? err.response.data.message : 'Upload failed.';
                this.isUploading = false;
            }
        },

        onImgError(event){
            event.target.src = window.location.origin + '/storage/Default.png'
        },
    },
}
</script>

<style scoped>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: margin 0.3s cubic-bezier(.4,0,.2,1);
}

.profile-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin: 0 auto;
    width: 1000px;
    max-width: 100%;
    transition: margin 0.3s cubic-bezier(.4,0,.2,1);
}

.profile-header {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
}

.profile-avatar {
    flex-shrink: 0;
}

.profile-avatar img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #f0f0f0;
}

.clickable-avatar { cursor: pointer; transition: transform 0.15s ease; }
.clickable-avatar:hover { transform: scale(1.04); }

/* Modal styles */
.modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index: 9999;
}
.modal-card{
    background: #fff;
    padding: 1.5rem;
    border-radius: 10px;
    width: 90%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    text-align: center;
}
.modal-card .preview img{ width: 160px; height: 160px; object-fit: cover; border-radius: 50%; border: 2px solid #eee; margin-bottom: 1rem; }
.modal-actions{ display:flex; gap:0.5rem; justify-content:center; margin-top:1rem }
.btn{ padding:0.5rem 1rem; border-radius:6px; border:none; cursor:pointer; background:#2c7be5; color:#fff }
.btn.secondary{ background:#e0e0e0; color:#333 }
.upload-message{ margin-top:0.75rem; color: #2c7be5 }

.profile-info {
    flex-grow: 1;
}

.profile-info h1 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
}

.info-row {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.info-row label {
    min-width: 100px;
    color: #666;
    font-weight: 600;
}

.info-row span {
    color: #2c3e50;
}

.logout-btn {
    margin-top: 1.5rem;
    padding: 0.8rem 1.5rem;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: #c0392b;
}

@media (max-width: 600px) {
    .profile-container {
        padding: 0 8px;
    }
    .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .profile-card {
        width: 100%;
        margin: 0 auto;
    }
    .profile-info {
        width: 100%;
    }
    .info-row {
        flex-direction: column;
        gap: 0.5rem;
    }
    .info-row label {
        min-width: auto;
    }
}
.modal-loader {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 1rem 0;
}
.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #2c7be5;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    animation: spin 0.8s linear infinite;
    margin-bottom: 0.5rem;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>