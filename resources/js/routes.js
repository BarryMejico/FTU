import{createRouter,createWebHistory} from 'vue-router'

import Home from '../vueTemplate/Home.vue'
import About from '../vueTemplate/about.vue'
import { useUser } from '../Store/user'
import { useMenus } from '../Store/menu'
import thisprofile from '../vueTemplate/profile/profile.vue'


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
        path:'/profile/:id',
        name:'Profile', 
        component:thisprofile,
        // meta:{
        //     requiresAuth:true,
        // },

    },
    {
        path:'/myprofile',
        name:'MyProfile',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/profile/myProfile.vue'),
        
        
        meta:{
            requiresAuth:true,
        },
        children:[
             {
                path:'/myDashboard',
                name:'profileoverview',
                component:()=>import('../vueTemplate/profile/profileoverview.vue'),
                meta:{
                    requiresAuth:true,
                },
            },
                {
                path:'/student',
                name:'student',
                component:()=>import('../vueTemplate/databuilder/student/student.vue'),
                meta:{
                    requiresAuth:true,
                },
            },
            {
                path:'/teacher-edit',
                name:'teacher-edit',
                component:()=>import('../vueTemplate/databuilder/teacher/teacher.vue'),
                meta:{
                    requiresAuth:true,
                },
            },

            {
                path:'/userDetails',
                name:'userDetails',
                component:()=>import('../vueTemplate/databuilder/userDetails.vue'),
                meta:{
                    requiresAuth:true,
                },
            },
        ]
    },
    
    {
        path:'/admin',
        name:'admin',
        component:()=>import('../vueTemplate/adminSystem/adminDashboard.vue'),
        // route protect
        beforeEnter:(to,from,next)=>{
            const menu = useMenus();
            var inmenu=menu.checkThisMenu(to.fullPath)
            
            if(inmenu){
                next()
            }
            else{
                next({name:'permissionDenied',query:{redirect:to.fullPath}})
            }
        },
        // meta:{
            
        //     requiresAuth:true,

        // },

        children:[

            {path:'/menu',
             name:'menulist',
            component:()=>import('../vueTemplate/adminSystem/menu/menu.vue')},
            
            {path:'/permission',
             name:'permission',
             component:()=>import('../vueTemplate/adminSystem/permission/permission.vue')},
            
             {path:'/permission-modify/:permcode',
             name:'modifypermission',   
             component:()=>import('../vueTemplate/adminSystem/permission/permissionEdit.vue')},
           
           {path:'/user',
            name:'users',
            component:()=>import('../vueTemplate/adminSystem/users/users.vue')},
        ]
    },

    {
        path:'/coursedirector',
        name:'coursedirector',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/CD/batch.vue'),
        children:[
             {path:'/batches',
             name:'subjects',
            component:()=>import('../vueTemplate/CD/batch.vue')},
            
        ]
    },

    {
        path:'/teacherdashboard',
        name:'teacherDashboard',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/teacherSystem/teacherDashboard.vue'),
        children:[
             {path:'/teacher-subjects',
             name:'subjects',
            component:()=>import('../vueTemplate/teacherSystem/subjects.vue')},
            
        ]
    },

    {
        path:'/:pathMatch(.*)*',
        name:'E404',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/404.vue')
    },

    {
        path:'/permissionDenied',
        name:'permissionDenied',
        // import function for lazy loading 
        component:()=>import('../vueTemplate/permissionDenied.vue')
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

    else{
        // next();
    }
})


    


export default router
