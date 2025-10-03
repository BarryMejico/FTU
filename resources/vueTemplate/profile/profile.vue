<template>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-image">
                    <!-- <img :src="profileID.Profile_Picture" /> -->
                    <img :src=" appURL + profileID.Profile_Picture"  onerror="image/Default.png" class="logo" />
                </div>
                <div class="profile-info">
                    <div class="info-item">
                        <label><b>Name:</b></label>
                        <span>{{ profileID.name }}</span>
                    </div>
                    <div class="info-item">
                        <label><b>Email:</b></label>
                        <span>{{ profileID.email }}</span>
                    </div>
                    <div class="info-item">
                        <label><b>ID:</b></label>
                        <span>{{ profileID.code }}</span>
                    </div>
                    <div class="info-item">
                        <label><b>Title:</b></label>
                        <div v-if="editpermission">
                            <select name="myDropdown" id="myDropdown">
                            <option value="option1">Student</option>
                            <option value="option2">Teacher</option>
                            <option value="option3">Admin</option>
                            </select>
                            <button class="btn btn-primary">Update</button>
                        </div>
                        <div v-else>
                            <span>{{ profileID.Description }}</span>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {useUser} from '../../Store/user'
import {useMenus} from '../../Store/menu'

export default {
    setup(){
        const menu = useMenus();
        const userData = useUser();
        return {menu,userData}
    },

    data() {
        return {
            profileID: {
                name: '',
                email: '',
                image_url: ''
            }
        }
    },

    async created() {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/thatProfile', {
                params: { id: this.$route.params.id }
            });
            this.profileID = response.data[0];
            
        } catch (error) {
            console.error('Error fetching profile:', error);
            this.profileID= {
                name: 'not found',
                email: '',
                image_url: ''
            }
        }
    },

    mounted(){  
        // this.checkifallowedit();
    },

    methods:{
        checkifallowedit(){   
        var i=0
        for(var i = 0; i < this.tools.length; i++){
            console.log(this.useUser[i].name);
        }
        }
    },

    computed:{
        appURL(){
            var path= window.location.origin + "/"
        return path
      },

        userData(){
            return this.userData.userData
        },

        editpermission(){
            var i=0
            var data=this.menu.menu
            for(var i = 0; i < data.length; i++){
            console.log(data[i].Description);
            if(data[i].Description=="Edit permission")
            console.log("found");
                return true
            }
            
            return false

        }
    }
}
</script>

<style scoped>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.profile-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 2rem;
}

.profile-header {
    display: flex;
    gap: 2rem;
    align-items: start;
}

.profile-image {
    flex-shrink: 0;
}

.profile-image img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #f0f0f0;
}

.profile-info {
    flex-grow: 1;
}

.profile-info h1 {
    margin-bottom: 1.5rem;
    color: #333;
}

.info-item {
    margin-bottom: 1rem;
}

.info-item label {
    display: inline-block;
    width: 80px;
    color: #666;
}

.info-item span {
    color: #333;
}

@media (max-width: 600px) {
    .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .info-item label {
        width: auto;
        margin-right: 0.5rem;
    }
}
</style>