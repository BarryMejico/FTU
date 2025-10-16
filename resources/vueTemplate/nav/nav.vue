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
                    <span>About us</span> 
                </router-link>
            </li>
            
            <li v-if="!userData.name" class="right" style="float:right">
                <router-link to="/login" class="nav-link">
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

            <li v-else class="right" style="display:flex;align-items:center;gap:8px;">
                <router-link :to="{name:'profileoverview'}" class="user-with-avatar">
                    <img :src="avatarUrl" @error="onAvatarError" alt="avatar" class="nav-avatar" />
                    <span class="username-text">{{userData.name}}</span>
                </router-link>
                <button class="navbar-logout-btn" @click="logout" aria-label="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
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
            appName: import.meta.env.VITE_APP_NAME || 'Finance Training Unit',
            avatarUrl: '/storage/Default.png'
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
        ,
        normalizedProfilePic(path){
            if(!path) return '/storage/Default.png'
            // remove any cache-busting query string for normalization
            const clean = path.split('?')[0];
            if(clean.startsWith('http')) return clean + (path.includes('?') ? ('?' + path.split('?').slice(1).join('?')) : '');
            if(clean.startsWith('/')) return window.location.origin + clean + (path.includes('?') ? ('?' + path.split('?').slice(1).join('?')) : '');
            // path like 'storage/profile_pictures/xxx' -> prefix origin
            return window.location.origin + '/' + clean.replace(/^\/+/, '') + (path.includes('?') ? ('?' + path.split('?').slice(1).join('?')) : '');
        },
        onAvatarError(event){
            event.target.src = '/storage/Default.png'
        }
    },
    created(){
        // initialize local avatar URL from store
        try{
            this.avatarUrl = this.normalizedProfilePic(this.userData.userData.Profile_Picture);
        }catch(e){
            this.avatarUrl = '/storage/Default.png';
        }
    },
    watch:{
        // watch the Pinia store for Profile_Picture changes and update avatarUrl
        'userData.userData.Profile_Picture': function(newVal){
            this.avatarUrl = this.normalizedProfilePic(newVal);
        }
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
    /* Clean gradient header, dot pattern removed */
    background: linear-gradient(90deg, #0b2546 0%, #071430 100%);
    position: relative;
    box-shadow: 0 6px 20px rgba(4,12,30,0.55), inset 0 -6px 20px rgba(2,8,18,0.25);
    /* Set z-index for navbar */
    z-index: 100;
}

/* subtle radial accent near the left (logo area) */
ul.topnav::before{
    /* Dot pattern removed: no pseudo-element background */
    content: none;
}

ul.topnav li {float: left;}
/* right-aligned nav items */
ul.topnav li.right{ float:right; }
/* app name sits beside logo */
.app-name{ display:flex; align-items:center; gap:10px }
.app-name .logo{ margin-right:6px }

/* Remove underlines from all navbar links */
ul.topnav li a, .topnav a, .nav-link, .user-with-avatar {
    text-decoration: none !important;
}

ul.topnav li span {
    display: block;
    color: #e6f2fb;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    border-radius:8px;
    transition: transform .16s ease, box-shadow .16s ease, background .12s ease;
}

/* unify hover for regular nav items and the profile link */
.app-name span:hover,
.user-with-avatar:hover,
ul.topnav li span:hover {
    background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    transform: translateY(-4px);
    box-shadow: 0 8px 18px rgba(2,12,30,0.35);
}

ul.topnav li .router-link-active span {background-color: rgba(0,163,196,0.12);}

/* make app-name active explicit so we have a single source of truth */
.app-name .router-link-active span{ 
    background: linear-gradient(180deg, rgba(0,163,196,0.12), rgba(0,163,196,0.06));
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,163,196,0.08);
    color: #e6f2fb; 
}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px) {
    ul.topnav li.right, ul.topnav li {
        float: none;
        width: 100%;
    }
}
ul.topnav {
        list-style-type: none;
        margin: 0;
        padding: 0 18px; /* horizontal breathing room */
        overflow: hidden;
        /* Clean gradient header, dot pattern removed */
        background: linear-gradient(90deg, #0b2546 0%, #071430 100%);
        position: relative;
        box-shadow: 0 6px 20px rgba(4,12,30,0.55), inset 0 -6px 20px rgba(2,8,18,0.25);
        z-index: 100;
}

/* small elevation for active route */
.topnav li .router-link-active span{
        background: linear-gradient(180deg, rgba(0,163,196,0.12), rgba(0,163,196,0.06));
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,163,196,0.08);
}

.user-icon{ margin-right:6px; font-size:16px; vertical-align:middle; color: #bcd7e8 }

/* Ensure username hover height matches app name/about links */
.user-with-avatar{ 
    display:inline-flex;
     align-items:center; gap:1px;
      padding: 14px 16px; 
      border-radius:8px;
       cursor:pointer; 
       transition: transform .16s ease, box-shadow .16s ease, background .12s ease; 
       border: none; background: transparent;
     }
.user-with-avatar .username-text{ padding: 0 0 0 0; color:#e6f2fb }
.user-with-avatar:hover{ background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); transform: translateY(-4px); box-shadow: 0 8px 18px rgba(2,12,30,0.35); }

/* stronger selector so the button hover always takes precedence over generic span:hover */
.topnav li .user-with-avatar:hover{ background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); transform: translateY(-4px); box-shadow: 0 8px 18px rgba(2,12,30,0.35); }

/* ensure the username text doesn't show its own hover — let the button handle visuals */
.user-with-avatar .username-text{ pointer-events: none; }
/* ensure inner username span never shows its own hover visuals */
.user-with-avatar .username-text:hover{ background: transparent; transform: none; box-shadow: none; }

/* active state for profile button to match other nav items */
.user-with-avatar.router-link-active{ 
    background: linear-gradient(180deg, rgba(0,163,196,0.12), rgba(0,163,196,0.06));
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,163,196,0.08);
    color: #e6f2fb;
}

/* mousedown / click feedback: make active (pressed) state match app-name active visuals */
.user-with-avatar:active,
.user-with-avatar:active .username-text{
    background: linear-gradient(180deg, rgba(0,163,196,0.12), rgba(0,163,196,0.06));
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,163,196,0.08);
    color: #e6f2fb;
}

/* active feedback for app-name link when mouse is pressed */
.app-name span:active{ 
    background: linear-gradient(180deg, rgba(0,163,196,0.12), rgba(0,163,196,0.06));
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,163,196,0.08);
    color: #e6f2fb; 
}

/* avatar */
.nav-avatar{
     width:28px;
     height:28px;
     border-radius:50%;
     object-fit:cover;
     margin-right:8px;
     border:1px solid rgba(255,255,255,0.12);
         }

/* reset button defaults inside navbar */
.user-with-avatar[role="button"], .user-with-avatar button{ 
    background: transparent;
     border: none; padding: 0; }
.user-with-avatar:focus{ 
    outline: none; 
    box-shadow: 0 0 0 4px rgba(0,163,196,0.12); }

/* Navbar logout button style */
.navbar-logout-btn {
  background: none;
  border: none;
  color: #e6f2fb;
  font-size: 1.3rem;
  cursor: pointer;
  padding: 6px 10px;
  border-radius: 6px;
  transition: background 0.18s, color 0.18s;
}
.navbar-logout-btn:hover {
  background: #0b2546;
  color: #fff;
  box-shadow: 0 0 12px 2px #fff, 0 0 32px 8px rgba(255,255,255,0.18);
}
</style>