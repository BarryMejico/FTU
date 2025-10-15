<template>
    <div class="menu-container">
         <h1 class="page-title">Menu Management</h1>
        <div class="actions-bar">
            <button class="btn-add" @click="showAddModal = true">
            <i class="ri-add-line"></i> Add New Menu
            </button>
        </div>
        <div class="table-responsive">
            <el-dialog title="Add/Edit Menu" v-model="showAddModal">
            <form @submit.prevent="saveMenu">
                <div class="form-group">
                <label>Description</label>
                <input v-model="formData.Description" type="text" required>
                </div>
                <div class="form-group">
                <label>Icon URL</label>
                <input v-model="formData.icon" type="text">
                </div>
                <div class="form-group">
                <label>Slug</label>
                <input v-model="formData.slug" type="text" required>
                </div>
                <div class="dialog-footer">
                <button type="button" @click="showAddModal = false">Cancel</button>
                <button type="submit">Save</button>
                </div>
            </form>
            </el-dialog>
            <div class="table-responsive"></div>
        <table class="menu-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Slug</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(menu,k) in allmenu" :key="k">
                    <td  v-if="menu.menuParent=='root'">
                        {{menu.id}}
                    </td>

                    <td  v-if="menu.menuParent=='root'">
                        <!-- {{menu.icon}} -->
                        <img :src="menu.icon" alt="" 
                                                style="width:25px; 
                                                height:25px; 
                                                object-fit:contain;
                                                "  />
                                                
                    </td>
                    <td  v-if="menu.menuParent=='root'">
                        {{menu.Description}}
                    </td>
                    <td  v-if="menu.menuParent=='root'">
                        {{menu.slug}}
                    </td>
                    <td v-if="menu.menuParent=='root'">
                        <table >
                            <t-head>
                                <tr>
                                    <th style="padding-left: 20px;">Icon</th>
                                    <th>Description</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </t-head>
                            <t-body>
                            <tr v-for="(subMenu, index) in allmenu" :key="index">
                                <td v-if="subMenu.menuParent ==  menu.id"
                                 style="padding-left: 20px;">
                                    <img :src="subMenu.icon" alt="" 
                                        style="width:20px; 
                                        height:20px; 
                                        object-fit:contain;
                                        "  />
                                </td>
                                <td v-if="subMenu.menuParent ==  menu.id">{{ subMenu.Description }}</td>
                                <td v-if="subMenu.menuParent ==  menu.id">{{ subMenu.slug }}</td>
                                <td v-if="subMenu.menuParent ==  menu.id">
                                    <div class="actions">
                                        <button class="btn-edit" @click="editMenu(subMenu)"><i class="ri-edit-line"></i> Edit</button>
                                        <button class="btn-delete" @click="deleteMenu(subMenu.id)"><i class="ri-delete-bin-6-line"></i> Delete</button>
                                    </div>
                                </td>
                            </tr>
                            </t-body>
                        </table>
                    </td>
                    <td  v-if="menu.menuParent=='root'">
                        <div class="actions">
                            <button class="btn-edit" @click="editMenu(menu)"><i class="ri-edit-line"></i> Edit</button>
                            <button class="btn-delete" @click="deleteMenu(menu.id)"><i class="ri-delete-bin-6-line"></i> Delete</button>
                        </div>
                    </td>
                    <td v-else style="display:none;"></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>
<script>
import axios from 'axios';


export default{
    
    setup(){

    },

    data(){
        return{
            showAddModal:false,
            formData:{
                id:'',
                icon:'',
                Description:'', 
                slug:'',
            },
            allmenu:[{
                id:'',
                icon:'',
                Description:'',
                slug:'',
            }],
        }
    },
    mounted(){
        this.getallmenu()
    },
    
    methods:{

        getallmenu(){
            axios.get('/api/listofMenu')
            .then(res=>{
                this.allmenu=res.data
            })
        },

        },


}
</script>

<style>
.menu-container {
    padding: 20px;
}

.page-title {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 24px;
}

.table-responsive {
    overflow-x: auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.menu-table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
}

.menu-table th,
.menu-table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.menu-table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #2c3e50;
}

.menu-table tr:hover {
    background-color: #f5f5f5;
}

.icon-name {
    margin-left: 8px;
    color: #666;
}

.actions {
    display: flex;
    gap: 8px;
}

.btn-edit,
.btn-delete {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-edit {
    background-color: #3498db;
    color: white;
}

.btn-delete {
    background-color: #e74c3c;
    color: white;
}

.btn-edit:hover {
    background-color: #2980b9;
}

.btn-delete:hover {
    background-color: #c0392b;
}

@media (max-width: 768px) {
    .menu-table {
        font-size: 14px;
    }
    
    .menu-table th,
    .menu-table td {
        padding: 8px;
    }
    
    .icon-name {
        display: none;
    }
}
</style>