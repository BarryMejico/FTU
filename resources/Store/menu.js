import {defineStore} from "pinia"
import axios from "axios";

export const useMenus =
defineStore("menu",{
    state:()=>{
        return{
            menu:[{slug:''
            }]
        }
    },

    actions:{
        async getMenu(id){
            await axios
                    .get('/api/menuList',{params:{'id':id}})
                    .then((res)=>{
                        this.menu=res.data
                    })
        },

        checkThisMenu(slug){
           var menu = this.menu;
           const menubyslug = menu.find(menu => menu.slug === slug)

            if (menubyslug) {
                return true;
            }
            else{
                return false;
            }

        }   
    }
})