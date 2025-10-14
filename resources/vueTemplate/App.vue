<template>

    <div class="app-root" :class="{ 'has-sidebar': showSidebar, 'sidebar-collapsed': ui.sidebarCollapsed }">
        <nav class="navbar">
        <div class="nav-container">
            <navigation></navigation>
        </div>
    </nav>
                <Loading v-if="ui.isLoading" />
    <!-- subtle glow behind the logo (fixed) -->
    <div class="bg-logo-glow" aria-hidden="true"></div>
    <!-- centered logo element (fixed) -->
        <div class="bg-logo" :style="{ backgroundImage: `url(${logoUrl})` }"></div>
        <!-- global grid overlay (fixed) placed above logo, below content -->
        <div class="bg-grid" aria-hidden="true"></div>
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
        /* Grid fade variables */
        :root {
            --grid-color-rgb: 144,205,244; /* light blue */
            --grid-alpha: 0.7;             /* line opacity */
            --grid-size: 40px;             /* square size */
            --grid-fade-start: 35%;        /* where fade begins (earlier for more fade) */
            --grid-fade-mid-opacity: 0.75; /* strength mid-way down */
            --grid-fade-mid-offset: 30%;   /* distance after start to reach mid strength */
        }
        /* Grid opacity presets (toggle on <html>) */
        html.grid-faint { --grid-alpha: 0.35 }
        html.grid-strong { --grid-alpha: 0.9 }
        html.grid-off { --grid-alpha: 0 }
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

        /* Background is applied globally via resources/css/app.css */

        /* Adjustable glow variables and presets */
        :root {
            --logo-glow-inner: 0.85;   /* center opacity */
            --logo-glow-mid: 0.35;     /* mid ring opacity */
            --logo-glow-size: 520px;   /* overall glow diameter */
            --logo-glow-blur: 6px;     /* blur strength */
        }

        /* Optional presets: apply to the <html> element */
        html.glow-none {
            --logo-glow-inner: 0;
            --logo-glow-mid: 0;
            --logo-glow-size: 0px;
            --logo-glow-blur: 0px;
        }
        html.glow-weak {
            --logo-glow-inner: 0.55;
            --logo-glow-mid: 0.18;
            --logo-glow-size: 460px;
            --logo-glow-blur: 4px;
        }
        html.glow-strong {
            --logo-glow-inner: 1;
            --logo-glow-mid: 0.5;
            --logo-glow-size: 640px;
            --logo-glow-blur: 12px;
        }
        /* centered fixed logo element above pattern; keep low opacity */
        .bg-logo {
            position: fixed;
            left: calc(50% + (var(--sidebar-width, 0px) * 0.5));
            top: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            height: 420px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.85; /* slightly stronger */
            pointer-events: none;
            z-index: 1; /* ensure logo sits above the grid overlay */
        }

        /* soft white glow behind the logo to improve contrast */
        .bg-logo-glow {
            position: fixed;
            left: calc(50% + (var(--sidebar-width, 0px) * 0.5));
            top: 50%;
            transform: translate(-50%, -50%);
            width: var(--logo-glow-size); /* adjustable size */
            height: var(--logo-glow-size);
            pointer-events: none;
            /* above grid (0), below logo (1) by using same layer as logo but earlier in DOM */
            z-index: 1;
            background: radial-gradient(circle, rgba(255,255,255,var(--logo-glow-inner)) 0%, rgba(255,255,255,var(--logo-glow-mid)) 40%, rgba(255,255,255,0) 70%);
            filter: blur(var(--logo-glow-blur));
        }

        /* full-screen grid overlay above logo, below main content */
        .bg-grid {
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0; /* grid sits below logo and content */
            background-image:
                /* stronger, smoother fade: transparent -> mid -> white */
                linear-gradient(
                    to bottom,
                    rgba(255,255,255,0) var(--grid-fade-start),
                    rgba(255,255,255,var(--grid-fade-mid-opacity)) calc(var(--grid-fade-start) + var(--grid-fade-mid-offset)),
                    rgba(255,255,255,1) 100%
                ),
                /* vertical grid lines */
                linear-gradient(to right, rgba(var(--grid-color-rgb), var(--grid-alpha)) 1px, rgba(var(--grid-color-rgb), 0) 1px),
                /* horizontal grid lines */
                linear-gradient(to bottom, rgba(var(--grid-color-rgb), var(--grid-alpha)) 1px, rgba(var(--grid-color-rgb), 0) 1px);
            background-size: auto, var(--grid-size) var(--grid-size), var(--grid-size) var(--grid-size); /* perfect squares */
            background-position: top left, top left, top left;
            background-repeat: no-repeat, repeat, repeat;
        }

        /* Sidebar width variable to keep the logo aligned with content center */
        .app-root { --sidebar-width: 0px; }
        .app-root.has-sidebar { --sidebar-width: 250px; }
        .app-root.has-sidebar.sidebar-collapsed { --sidebar-width: 72px; }

        /* On small screens, layout stacks; keep logo centered to viewport */
        @media (max-width: 768px) {
            .app-root { --sidebar-width: 0px; }
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