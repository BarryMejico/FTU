<template>
    <div>

         <div class="search-container">
                <div class="search-box">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" placeholder="Search" id="searchInput">
                </div>
                <div class="results-count" id="resultsCount"></div>
            </div>
        
        <div class="users-grid" id="usersGrid">
            <div v-for="(profile, index) in profileID" :key="index">
                <!-- {{ profile }} -->
                <profile-card :userdetails="profile" @click.prevent="loadprofile(profile.code)"></profile-card>
            </div>  

        </div>

    </div>
</template>

<script>
import axios from 'axios';
import profileCard from '../../profile/profile_card.vue';

export default {
  components:{
    profileCard,
  },

   data() {
        return {
            profileID: [{
                name: 'Sampple Yarn',
                email: '',
                id:1,
            }]
        }
    
    },

        mounted() {
        this.loadlist_profile();
    },


  methods:{

    loadprofile(id){
        
        this.$router.push({path:"/profile/"+id});
    },
    
    loadlist_profile(){
         axios
        .get('/api/users')
        .then(response => {
            this.profileID = response.data;
            // console.log(this.profileID);
        })
        .catch(error => {
            console.error('Error fetching users:', error);  
        }); 
    }
       
}
}
</script>

<style>
 .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
 /* Search Bar Styles */
        .search-container {
            position: relative;
            margin-bottom: 3rem;
        }

        .search-box {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            display: block;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            background: white;
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 1.2rem;
            pointer-events: none;
        }
</style>