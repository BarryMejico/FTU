<template>
    <div>
        <h1>Login</h1>
        <form>
            <label>User Name:</label>
            <input type="text" placeholder="User Name" v-model="data.email"><br>

            <label>Password:</label>
            <input type="password" placeholder="Password" v-model="data.password"> <br>
            
            <button type="button" @click.prevent="login()">Login</button>
        </form>
        <router-link to="/regster">
            Register
        </router-link>
    </div>
</template>

<script>
import axios from 'axios';
import { useUser } from '../../Store/user';
export default{
setup(){
        const userDatax=useUser();
        return {userDatax}
},
data(){
    return{
        data:{
            email:'',
            password:'',
        }
    }
},
methods:{
    async login(){
        const redirectPath = this.$route.query.redirect
        if(await this.userDatax.loginuser(this.data)){
            if(undefined!=redirectPath){
                this.$router.push(redirectPath)
            }
            else{this.$router.push("/myprofile")}
        }
        },
},
computed:{
        userData(){
            return this.userDatax.userData
        }
    },
watch:{
    userData(newvalue){
        if(newvalue.id){
            const redirectPath = this.$route.query.redirect
            if(undefined!=redirectPath){
                this.$router.push(redirectPath)
            }
            else{this.$router.push("/myprofile")}

        }

    }
}
}
</script>