<template>

  <div>
  <nav class="navbar">
        <div class="nav-container">
            <navigation></navigation>
        </div>
    </nav>
  <div class="main-container">
    <aside class="sidebar">
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
import ToolBar from './nav/menubar.vue';
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
    
  },

  setup() {
        const userData=useUser();
        return {userData}
   },

   async created(){

   },

   mounted(){
    const userData=useUser();
    userData.logUser()
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
            grid-template-columns: 250px 1fr;
            gap: 2rem;
        }

         /* Left Menu */
        .sidebar {
            /* background: #f8f9fa; */
            border-radius: 10px;
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
            /* background: #2c3e50; */
            /* color: white; */
            text-align: center;
            padding: 2rem 0;
            margin-top: auto;
        }
         .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

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