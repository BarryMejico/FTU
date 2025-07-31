<template>
    <div>
        <h1>My Profile</h1>
        <label>Name: </label><span>{{ userData.userData.name }}</span><br>
        <label>ID: </label><span>{{ userData.userData.id }}</span><br>
        <label>email: </label><span>{{ userData.userData.email }}</span><br>
        <button type="button" @click="logout">LogOut</button>
    </div>
</template>
<script>
import axios from 'axios';
import { useUser } from '../../Store/user';
export default{
    setup(){
        const userData = useUser();
        return {userData}
    },
    
        methods:{
        logout(){
                this.userData.logout()
                this.$router.push("/login")
        }
    },
}
</script>