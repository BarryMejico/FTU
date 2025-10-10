<template>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <img :src="userData.userData.Profile_Picture || '/image/Default.png'" alt="Profile Picture">
                    
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
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';
import { useUser } from '../../Store/user';
import Profile_nav from '../nav/profile_nav.vue';

export default {
    components: {Profile_nav},
    setup() {
        const userData = useUser();
        return { userData }
    },
    
    methods: {
        logout() {
            this.userData.logout()
            this.$router.push("/login")
        }
    },
}
</script>

<style scoped>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 20px;
}

.profile-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
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
    .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
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
</style>