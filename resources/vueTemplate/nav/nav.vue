
<template>
    <div>
        <nav>
        <ul class="topnav">
                <li>
                    <img :src="logoUrl" alt="Logo" class="logo" />
                </li>
   
            <li>
                <router-link to="/">
                    <span>{{ appName }}</span>
                </router-link>
            </li>
            <li>
                <router-link to="/about">
                    <span>About</span> 
                </router-link>
            </li>
            
            <li v-if="!userData.name" class="right" style="float:right">
                <router-link to="/login">
                    <span>Log in</span>
                </router-link>
            </li>
         
            
            <!-- <li v-else>
                <router-link 
                :to="{name:'Profile',params:{id:'2424021658-0',name:'Barry'}}" 
                >
                   <span>Profile</span> 
                </router-link>
            </li> -->

            <li v-else>
                <router-link 
                    :to="{name:'profileoverview'}" 
                    >
                       <span> {{userData.name  }}</span>
                </router-link>
            </li>
        </ul>
    </nav>

        <!-- Back button removed as requested -->
        
    </div>
</template>
<script>
import { useUser } from '../../Store/user'

export default{
    setup(){
        const userData=useUser();
        // Resolve logo path via Vite so it works in dev and build
        const logoUrl = new URL('../../images/ftu_logo.png', import.meta.url).href;
        return {userData, logoUrl}
    },
    data(){
        return{
            appName: import.meta.env.VITE_APP_NAME || 'FTU Portal'
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

.logo {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}
#nav .router-link-active{
    color:red;
}

ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
 background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
background:#00004D;
}

ul.topnav li {float: left;}

ul.topnav li span {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

ul.topnav li span:hover {background-color: #1C2951;}

ul.topnav li .router-link-active span {background-color: #131E3A;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px) {
  ul.topnav li.right, 
  ul.topnav li {float: none;}
}
.topnav a {
    text-decoration: none; /* remove underline from all nav links */
    color: inherit;
}
.router-link-active {
    font-weight: bold;
    text-decoration: none;
}
/* Responsive Design */
@media screen and (max-width: 600px) {
  ul.topnav li {
    float: none;
    width: 100%;
  }
}   
</style>