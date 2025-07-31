<template>
    <div>
        <h1>
            Menu
        </h1>
        <table>
            <thead>
                <th>#</th>
                <th>Icon</th>
                <th>Description</th>
                <th>Slug</th>
            </thead>
            <tbody>
                <tr v-for="(menu,k) in menu" :key="k">
                    <td>
                        {{menu.id}}
                    </td>
                    <td>
                        {{menu.icon}}
                    </td>
                    <td>
                        {{menu.Description}}
                    </td>
                    <td>
                        {{menu.slug}}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>
<script>
import {useMenus} from '../../../Store/menu'
import {useUser} from '../../../Store/user'


export default{
    setup(){
        const menu = useMenus();
        const userData = useUser();
        return {menu,userData}
    },

    data(){
        return{
            
        }
    },
    methods:{
       
    },
    computed:{
        userData(){
            return this.userData.userData
        },

        menu(){
            return this.menu.menu
        }
    }
}
</script>