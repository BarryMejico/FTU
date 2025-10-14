<template>
    <div>
        <form>
            <div class="form-group">
                <label for="desc">Description</label>
                <h1>{{ SelectedMenu[0].Description }}</h1>
            </div>

        </form>

       <div class="tools2">
        <input
                            type="checkbox"
                            v-model="selectAll"
                            @change="updateSelectAll"
                            
                        />Select all
                    <ul>
                     <li v-for="(tool,k) in menus" :key="k">
               
                <span v-if="tool.menuParent=='root'">
                    
                    <span v-if="tool.slug === '0'">
                    <span>
                        <input
                            type="checkbox"
                            v-model="tool.Selected"
                            @change="updateSelect(tool)"
                            
                        />
                        
                        {{ tool.Description }}</span>
                    <ul>
                        <li v-for="(subtool,j) in menus" :key="j">
                            <span v-if="subtool.menuParent ==  tool.id">
                                    <span><input
                                            type="checkbox"
                                            v-model="subtool.Selected"
                                            @change="updateSelect(subtool)"
                                        />
                                        
                                        {{ subtool.Description }}</span> 
                            </span>
                        </li>
                    </ul>
                    </span>   

                    <span v-else>
                        
                            <span>
                                 <input
                                            type="checkbox"
                                            v-model="tool.Selected"
                                            @change="updateSelect(tool)"
                                        />{{ tool.Description }}</span>     
                    </span>
                    </span>
                    
                    <span v-if="tool.menuParent=='x'">
                        <span>
                        <input
                                            type="checkbox"
                                            v-model="tool.Selected"
                                            @change="updateSelect(tool)"
                                        />
                         {{ tool.Description }}</span>  
                    </span>

                    </li>
                    </ul>
                    </div>
                    <button class="btn btn-primary mt-2" @click="savethis()">Save</button>
                
                    <hr>


                    
                    
    </div>
</template>

<script>
import axios from 'axios';
import {useMenus} from '../../../Store/menu'
import {useUser} from '../../../Store/user'
import { toHandlers } from 'vue';


export default {
    setup(){
        const menu = useMenus();
        const userData = useUser();
        return {menu,userData}
    },

    data() {
        return {
            form: {
                description: '',
                
            },
            selectAll: false,
            SelectedMenu: [{
                id: '',
                Description: ''
                }],
            menus:[{}],
            listmenParent:[],
            tableData:[{}]
        }
    },

    mounted() {

    },

    async created() {
        try {
            const response2 = await axios.get('http://127.0.0.1:8000/api/listofMenu')
            this.tableData = response2.data;

            const response = await axios.get('http://127.0.0.1:8000/api/thisPermissions', {
                params: { id: this.$route.params.permcode }
            });

            this.SelectedMenu = response.data;
            if(this.SelectedMenu.length==0){
                console.log('no data')
            }

            


            this.menuData()
            
        } catch (error) {
            this.profileID= {
                name: 'not found',
                email: '',
                image_url: ''
            }
        }
    },
    
    
    methods: {
        savethis(){
            var selectedmenus=[]
            this.menus.forEach(menux => {
                // console.log(menux.Selected)
                        if(menux.Selected){
                            selectedmenus.push({
                                permiCode: this.SelectedMenu[0].permCode,
                                id: menux.id,
                            })
                        }
                    });

            axios.post('http://127.0.0.1:8000/api/UpdatePermissions', {
                selectedmenus: selectedmenus,
            })

        },

        updateSelect(selectedmenudata) {
            var parentId =  parseInt(selectedmenudata.menuParent);
           
            if(selectedmenudata.menuParent=="root"){
                // console.log(selectedmenudata.Selected)
                if(!selectedmenudata.Selected){
                    this.menus.forEach(menux => {
                        if(menux.menuParent==selectedmenudata.id){
                            menux.Selected = false;
                        }
                    });
                }
                else{
                    this.menus.forEach(menux => {
                        if(menux.menuParent==selectedmenudata.id){
                            menux.Selected = true;
                        }
                    });
                }
            }
            
            this.menus.forEach(menux => {
                
                if (menux.id === parentId) {
                    
                        menux.Selected = true;
                }
            });


            // this.menus.forEach(menux => {
            //     var parentHaschild=[]
            //     if(selectedmenudata.menuParent=="root"){
            //         menux.selected=false
            //     }

            //     if (menux.selected) {
            //             parentHaschild.push(menux.menuParent)
            //     }
            // });


        },
        
        menuData(){
        
            var i=0;
            for(i=0;i<this.tableData.length;i++){
                var selected
                var j=0;

                for(j=0;j<this.SelectedMenu.length;j++){
                    if(this.SelectedMenu[j].id==this.tableData[i].id){
                        selected=true
                        break
                    }else{
                        selected=false
                    }
                }
                this.menus.push({
                    Selected: selected,
                    id: this.tableData[i].id,
                    icon: this.tableData[i].icon,
                    permCode: this.tableData[i].permCode,
                    Description: this.tableData[i].Description,
                    menuParent: this.tableData[i].menuParent,
                    slug: this.tableData[i].slug,
                })
            }
            // return menus;
        },

        fetchPermissions(){
            axios
            .get('http://127.0.0.1:8000/api/listofMenu')
            .then((res)=> {
                this.tableData = res.data;
            })
        },

        editPermission(permission) {
            // Implement edit logic
            console.log('Edit permission:', permission)
        },
        deletePermission(id) {
            // Implement delete logic
            console.log('Delete permission:', id)
        }
    },

        computed:{
        
        userData(){
            return this.userData.userData
        },

    },
    
 watch: {
        selectAll(newValue) {
            
            this.menus.forEach(menu => {
                menu.Selected = newValue;
            });
        },

      
}
}

</script>

<style scoped>
.form-group {
    margin-bottom: 1rem;
}

.tools2 ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  /* background-color: #f1f1f1; */
}

.tools2 li span{
  display: block;
  color: #000;
  padding: 2px 8px;
  text-decoration: none;
}

/* Change the link color on hover */
/* .tools li span:hover {
  background-color: #667eea;
  color: white;
} */
</style>

