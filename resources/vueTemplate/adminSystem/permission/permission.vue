<template>
    <div class="permission-container">
        <h1 class="page-title">Permission Management</h1>
        
        <!-- Table Component -->
        <div class="table-responsive">
            <table class="permission-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(permission, index) in permissions" :key="permission.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ permission.permCode }}</td>
                        <td @click="toedit(permission.permCode)">{{ permission.Description }}</td>
                        <td>
                            <button class="btn-edit" @click="editPermission(permission)">Edit</button>
                            <button class="btn-delete" @click="deletePermission(permission.id)">- Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn-add" @click="addPermission()">+ ADD</button></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {useUser} from '../../../Store/user'
import {useMenus} from '../../../Store/menu'

export default {
    setup(){
        const menu = useMenus();
        const userData = useUser();
        return {menu,userData}
    },

    data() {
        return {
            permissions: [
                // Sample data - replace with actual API calls
                { id: 1, code: 'VIEW_DASHBOARD', description: 'Can view dashboard' },
                { id: 2, code: 'MANAGE_USERS', description: 'Can manage users' }
            ]
        }
    },

    

    mounted() {
        // Fetch permissions from API
        this.fetchPermissions();
    },
    
    
    methods: {
        toedit(permcode){
            this.$router.push("/permission-modify/"+permcode)
        },
        fetchPermissions(){
            axios
            .get('api/listofPermissions')
            .then((res)=> {
                this.permissions = res.data;
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
    }
}
</script>

<style scoped>
.permission-container {
    padding: 20px;
}

.page-title {
    margin-bottom: 20px;
    color: #333;
}

.table-responsive {
    overflow-x: auto;
}

.permission-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.permission-table th,
.permission-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.permission-table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.permission-table tr:hover {
    background-color: #f5f5f5;
}

.btn-edit,
.btn-add,
.btn-delete {
    padding: 6px 12px;
    margin: 0 4px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-edit {
    background-color: #007bff;
    color: white;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
}

.btn-edit:hover {
    background-color: #0056b3;
}

.btn-delete:hover {
    background-color: #c82333;
}
</style>