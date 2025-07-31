import{createRouter,createWebHistory} from 'vue-router'

import Home from '../vueTemplate/Home.vue'
import About from '../vueTemplate/about.vue'
import { useUser } from '../Store/user'

// import Login from '../vueTemplate/Auth/login.vue'
// import Register from '../vueTemplate/Auth/registration.vue'

const routes=[
    {
        path:'/',
        name:'Home',
        component:Home
    },
    {
        path:'/about',
        name:'about',
        component:About
    },
    {
        path:'/login',
        name:'login',
        component:()=>import('../vueTemplate/Auth/login.vue')
    },
    {
        path:'/regster',
        name:'Register',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/Auth/registration.vue')
    },
    {
        path:'/profile/:id/:name',
        name:'Profile',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/profile/profile.vue')
    },
    {
        path:'/myprofile',
        name:'MyProfile',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/profile/myProfile.vue'),
        // route protect
        // beforeEnter:(to,from,next)=>{
        //     axios.get('api/user').then(() => {
        //             next()
        //         })
        //         .catch(()=>{
        //             return next({ name: 'login', query:{redirect:to.fullPath} })
        //         })        
        // },
        meta:{
            requiresAuth:true,
        },
    },

    {
        path:'/admin',
        name:'admin',
        component:()=>import('../vueTemplate/adminSystem/adminDashboard.vue'),
        meta:{
            requiresAuth:true,
        },

        children:[
            {path:'/',
            name:'menulist',
           component:()=>import('../vueTemplate/adminSystem/menu/menu.vue')},

            {path:'/menu',
             name:'menulist',
            component:()=>import('../vueTemplate/adminSystem/menu/menu.vue')},
            
            {path:'/permission',
             name:'permission',
             component:()=>import('../vueTemplate/adminSystem/permission/permission.vue')},
           
           {path:'/user',
            name:'users',
            component:()=>import('../vueTemplate/adminSystem/users/users.vue')},
        ]
    },



    {
        path:'/:pathMatch(.*)*',
        name:'E404',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/404.vue')
    },



]

const router=createRouter({
    history:createWebHistory(),
    routes,
    scrollBehavior(to,from,savedPosition){
        // return{
        //     top:null,
        //     left:null,
        //     behavior:null
        // }

        return savedPosition || {top:0}
    }
})  

router.beforeEach((to,from)=>{
    const authen=useUser();
    if(to.meta.requiresAuth && !authen.userData.name){
        return{name:'login',query:{redirect:to.fullPath}}
    }
})
    


export default router