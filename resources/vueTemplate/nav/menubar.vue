<template>
    <div v-if="userData.name" class="tools">
        <ul>
            <li><b>Menu</b></li>
            <li v-for="(tool,k) in tools" :key="k">
               
                <span v-if="tool.menuParent=='root'">
                    <span v-if="tool.slug === '0'">
                    <span>{{ tool.Description }}</span>
                    <ul>
                        <li v-for="(subtool,j) in menu.menu" :key="j">
                            <span v-if="subtool.menuParent ==  tool.id">
                                <router-link :to="subtool.slug">
                                    <span>{{ subtool.Description }}</span> 
                                </router-link>       
                            </span>
                        </li>
                    </ul>
                </span>     
                <span v-else>
                        <router-link :to="tool.slug">
                            <span>{{ tool.Description }}</span> 
                        </router-link>        
                </span>
                </span>

                </li>
        </ul>

        

    </div>
    
</template>
<script>
import {useMenus} from '../../Store/menu'
import {useUser} from '../../Store/user'
export default{
    
    setup(){
        const menu = useMenus();
        const userData = useUser();
        return {menu,userData}
    },
    data(){
        return{
            // tools:[{
            //     text:'tool1',
            //     slug:'/myprofile',
            // },{
            //     text:'tool2',
            //     slug:'',
            // }],
        }
    },
    computed:{
        userData(){
            return this.userData.userData
        },

        tools(){
            return this.menu.menu
        }
    }

    
}
</script>

<style>
.tools ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
}

.tools li span{
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

/* Change the link color on hover */
.tools li span:hover {
  background-color: #555;
  color: white;
}
</style>

