<template>

    <div class="app-root">
        <nav class="navbar">
        <div class="nav-container">
            <navigation></navigation>
        </div>
    </nav>
                <Loading v-if="ui.isLoading" />
        <!-- centered logo element (fixed) -->
        <div class="bg-logo" :style="{ backgroundImage: `url(${logoUrl})` }"></div>
    <div class="main-container" :class="{ 'has-sidebar': showSidebar, 'sidebar-collapsed': ui.sidebarCollapsed }">
        <aside v-if="showSidebar" class="sidebar">
                        <ToolBar></ToolBar>
                </aside>
                <main class="content">
                        <router-view :key="$route.path"></router-view>
                </main>
    </div>
  <footer class="footer">
        <div class="footer-content">
          <myfooter></myfooter>
        </div>
    </footer>
  </div>
</template>


<script>
import navigation from './nav/nav.vue'
import myfooter from './myfooter/myfooter.vue'
import { useUser } from '../Store/user';
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import ToolBar from './nav/menubar.vue';
import Loading from './adminSystem/Loading.vue'
import { useUi } from '../Store/ui'
        // Simple mobile menu toggle functionality
        // document.querySelector('.mobile-menu').addEventListener('click', function() {
        //     const navLinks = document.querySelector('.nav-links');
        //     navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        // });
export default {
  components:{
    navigation,
    myfooter,
    ToolBar
        ,Loading
  },

        setup() {
                                                        const userData=useUser();
                                                        const ui = useUi();
                                                        const route = useRoute()

                                                        const showSidebar = computed(() => {
                                                            // don't show sidebar on public routes
                                                            const hidden = ['login', 'Register', 'about']
                                                            if (hidden.includes(route.name)) return false
                                                            // require a logged-in user: either authenticated flag or userData.name
                                                            return !!userData.authenticated || (!!userData.userData && !!userData.userData.name)
                                                        })
                                // resolve logo URL with Vite so it loads correctly in dev and build
                                const logoUrl = new URL('../images/ftu_logo.png', import.meta.url).href;
                                                        return {userData, ui, logoUrl, showSidebar}
         },

   async created(){

   },

   mounted(){
    const userData=useUser();
    userData.logUser()
     // Show global loader for 5 seconds on app mount
     try{
         const ui = useUi();
         ui.showFor(5000)
     }catch(e){}
   },

   methods:{
    async get_logUser(){

    }
   }

   
}
</script>

<style>
body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            /* color: #333; */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

/* Navigation */
        .navbar {
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            /* color: white; */
            /* padding: 1rem 0; */
            /* box-shadow: 0 2px 10px rgba(0,0,0,0.1); */
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            /* padding: 2rem; */
            flex: 1;
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        /* When the sidebar is present, use two columns */
        .main-container.has-sidebar { grid-template-columns: 250px 1fr }

    /* When the sidebar is collapsed, use a narrow column and center content */
    .main-container.sidebar-collapsed.has-sidebar { grid-template-columns: 72px 1fr }
    .main-container.sidebar-collapsed.has-sidebar .content { display:flex; justify-content:center }

        /* subtle repeating pattern for the page */
        html, #app {
            background-color: #fbfbfb;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 10 10'><circle cx='1' cy='1' r='0.7' fill='%23e9e9e9' fill-opacity='0.6'/></svg>");
            background-repeat: repeat;
        }

        /* centered fixed logo element above pattern; keep low opacity */
        .bg-logo {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            height: 420px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.6;
            pointer-events: none;
            z-index: 0;
        }

    .main-container { position: relative; z-index: 1; padding-bottom: 120px; }

         /* Left Menu */
        .sidebar {
            /* remove top corner curve so sidebar aligns flush with navbar */
            border-radius: 0;
            padding: 1.5rem;
            height: fit-content;
            /* box-shadow: 0 2px 15px rgba(0,0,0,0.1); */
        }

        .sidebar h3 {
            /* color: #667eea; */
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
         .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
            background: #071430; /* match sidebar */
            box-shadow: 0 -2px 8px rgba(0,0,0,0.06);
            z-index: 9999;
            padding: 12px 0;
            color: #e6f2fb;
        }
        
        /* .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        } */

         /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu {
                display: block;
            }

            .main-container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            .sidebar {
                order: 2;
            }

            .content {
                order: 1;
            }

            .content h1 {
                font-size: 2rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 0 1rem;
            }

            .content {
                padding: 1rem;
            }

            .sidebar {
                padding: 1rem;
            }
        }
</style>