<template>
    <div>
        <h1>
            REGISTRATION
        </h1>
        
        <form>
            <label>Name:</label>
            <input type="text" placeholder="Name" v-model="Data.name"><br>
            <label v-if="err.name">{{ err.name }}<br></label>

            <label>Email:</label>
            <input type="email" placeholder="Email" v-model="Data.email"><br>
            <label v-if="err.email">{{ err.email }}<br></label>
            
            <label>Password:</label>
            <input type="password" placeholder="Password" v-model="Data.password"><br>
            <label v-if="err.password">{{ err.password }}<br></label>

            <label>Confirm Password:</label>
            <input type="password" placeholder="Confirm Password" v-model="Data.password_confirmation"><br>
            
            <button type="button" @click.prevent="register()">Register</button><br>
            <label v-if="message">{{ message }}</label>
        </form>
    </div>
</template>
<script>
import axios from 'axios';

export default{
    data(){
        return{
        Data:{
            name:'',
            email:'',
            password:'',
            password_confirmation:''
        },
        err:'',
        message:'',
    }
        
    },

    methods:{
        register(){
            axios.post('/api/register',this.Data)
                 .then((response)=>{
                    this.message=response.data
                    console.log(this.message);
                    this.clearData()
                 })
                 .catch((err)=>{
                    this.err=err.response.data.errors
                    console.log(err.response.data.errors);
                 })
        },

        clearData(){
            this.Data={
                name:'',
                email:'',
                password:'',
                password_confirmation:''
            }
            this.err=''
        }
    },
}
</script>