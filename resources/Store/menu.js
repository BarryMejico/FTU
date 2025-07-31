import {defineStore} from "pinia"
import axios from "axios";

export const useMenus =
defineStore("menus",{
    state:()=>{
        return{
            menu:{
                
            }
        }
    },

    actions:{
        async getMenu(id){
            await axios
                    .get('/api/menuList',{params:{'id':id}})
                    .then((res)=>{
                        this.menu=res.data
                    })
        }
    }
})