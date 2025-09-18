import {defineStore} from "pinia"
import axios from "axios";

import {useMenus} from '../Store/menu'


export const useUser =
defineStore("code",{
    // state
    state:()=>{
        return{
            authenticated:false,
            userData:{
                id: null,
                        name: null,
                        code: null,
                        permiCode: null,
                        email: null,
                        email_verified_at: null,
                        Profile_Picture: null,
                        created_at: null,
                        updated_at: null
            }
        }
    },
    // actions
    actions:{
        authenticate(){
            this.authenticated=true
        },

        logout(){
            axios
                .post('http://127.0.0.1:8000/api/logout')
                .then(()=>{
                    this.userData={
                        id: null,
                        name: null,
                        code: null,
                        permiCode: null,
                        email: null,
                        email_verified_at: null,
                        Profile_Picture: null,
                        created_at: null,
                        updated_at: null
                    }
                    window.location.reload(); // Reloads the current page
                })
                .catch((err)=>{
                    console.log(err);
                })
        },

        async loginuser(data){
            const useMenusa = useMenus(); 
            axios.get('/sanctum/csrf-cookie').then(async response => {
                   await axios
                   .post('/api/login',data)
                   .then((res)=>{
                        this.userData=res.data
                        useMenusa.getMenu(res.data.id)
                        // window.location.reload(); // Reloads the current page
                        return true
                   })
                   .catch((err)=>{
                        console.log(err);
                        alert("Login Failed")
                        return false
                     })

           });
        },

        async logUser(){
            const useMenusa = useMenus();             
             try {
                const res = await axios.get('http://127.0.0.1:8000/api/user');
                this.userData=res.data
                useMenusa.getMenu(res.data.id)
                
                            return true
            } catch (error) {
                // console.error('Error fetching data:', error);
                return false;
            
    }
        }
    },
    
    // getters

    getter:{
        async get_logUser(){
            await axios.get('http://127.0.0.1:8000/api/user')
                        .then((res)=>{
                           this.userData=res.data
                            return res.data
                        })
                        .catch((err)=>{
                            console.log(err.response.data)
                        })
        }
    }
    
})

