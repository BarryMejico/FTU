
<template>
    <div>
        <nav>
        <ul class="topnav">
                <li>
                    <img :src="logoUrl" alt="Logo" class="logo" />
                </li>
   
            <li class="app-name">
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

            <li v-else class="right">
                <router-link 
                    :to="{name:'profileoverview'}" 
                    >
                       <span><i class="ri-user-3-line user-icon" aria-hidden="true"></i> {{userData.name}}</span>
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
            appName: import.meta.env.VITE_APP_NAME || 'Finance Training Unit'
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
    padding: 0 18px; /* horizontal breathing room */
    overflow: hidden;
    /* 3D layered gradient header */
    background: linear-gradient(180deg, #0b2546 0%, #071430 45%, #041726 100%);
    position: relative;
    box-shadow: 0 6px 20px rgba(4,12,30,0.55), inset 0 -6px 20px rgba(2,8,18,0.25);
}

/* subtle radial accent near the left (logo area) */
ul.topnav::before{
    content:'';
    position:absolute;
    left:12px;
    top:6px;
    width:220px;
    height:60px;
    background: radial-gradient(ellipse at left center, rgba(0,163,196,0.06), transparent 40%);
    pointer-events:none;
}

ul.topnav li {float: left;}
/* right-aligned nav items */
ul.topnav li.right{ float:right; }
/* app name sits beside logo */
.app-name{ display:flex; align-items:center; gap:10px }
.app-name .logo{ margin-right:6px }


ul.topnav li span {
    display: block;
    color: #e6f2fb;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    border-radius:8px;
    transition: transform .16s ease, box-shadow .16s ease, background .12s ease;
}

ul.topnav li span:hover {
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    transform: translateY(-4px);
    box-shadow: 0 8px 18px rgba(2,12,30,0.35);
}

ul.topnav li .router-link-active span {background-color: rgba(0,163,196,0.12);}

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
/* header toggle button */
/* header toggle removed */
/* Responsive Design */
@media screen and (max-width: 600px) {
  ul.topnav li {
    float: none;
    width: 100%;
  }
}   

/* small elevation for active route */
.topnav li .router-link-active span{
        background: linear-gradient(180deg, rgba(0,163,196,0.12), rgba(0,163,196,0.06));
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,163,196,0.08);
}

.user-icon{ margin-right:6px; font-size:16px; vertical-align:middle; color: #bcd7e8 }
</style>