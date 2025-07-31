
<template>
    <div>
        <nav>
        <ul class="topnav">
            <li>
                <router-link to="/">
                    <span>Home</span>
                </router-link>
            </li>
            <li>
                <router-link to="/about">
                    <span>About</span> 
                </router-link>
            </li>
            
            <li v-if="!userData.name" class="right">
                <router-link to="/login">
                    <span>Login</span>
                </router-link>
            </li>
            <li v-else class="right">
                    <span @click="logout">Logout</span>
            </li>
            
            <!-- <li v-else>
                <router-link 
                :to="{name:'Profile',params:{id:'2424021658-0',name:'Barry'}}" 
                >
                   <span>Profile</span> 
                </router-link>
            </li> -->

            <li v-if="!userData.name" class="right">
                <router-link to="/regster">
                        <span>Sign up</span> 
                </router-link>
            </li>
            <li v-else>
                <router-link 
                    :to="{name:'MyProfile'}" 
                    >
                       <span> {{userData.name  }}</span>
                </router-link>
            </li>
        </ul>
    </nav>

        <span @click.prevent="goback">
            Back
        </span>
        
    </div>
</template>
<script>
import { useUser } from '../../Store/user'

export default{
    setup(){
        const userData=useUser();
        return {userData}
    },
    data(){
        return{
            
        }
    },
    methods:{
        goback(){
            this.$router.back()
        },
        logout(){
                this.userData.logout()
                this.$router.push("/login")
        }

    },
    watch:{

        
    },
    
    computed:{
        userData(){
            return this.userData.userData
        }
    }
}
</script>


<style>
#nav .router-link-active{
    color:red;
}

ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li span {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

ul.topnav li span:hover {background-color: #111;}

ul.topnav li .router-link-active span {background-color: #04AA6D;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px) {
  ul.topnav li.right, 
  ul.topnav li {float: none;}
}
</style>