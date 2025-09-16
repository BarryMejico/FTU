<template>
    <div class="menu-container">
         <h1 class="page-title">Menu Management</h1>
        <div class="table-responsive">
        <table class="menu-table">
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