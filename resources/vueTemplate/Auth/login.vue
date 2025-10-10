<template>



  <div class="login-container">
    <div class="login-card">
        <div class="login-icon">
            <i class="fas fa-user-circle"></i>
         </div>

                    <h1>Login</h1>
                    <form>
                        <div class="form-group">
                        <input type="text"  class="form-control" placeholder=" " id="username" v-model="data.email" required autofocus>
                        <label for="username">User name</label>
                        </div>
                
                        <div class="form-group">
                        <input type="password" class="form-control" placeholder=" " id="password"v-model="data.password" required>
                        <label for="password">Password</label>
                        </div>

                        <button type="submit" class="btn btn-login w-100" @click.prevent="login()">Login</button>
                    </form>
                <router-link to="/regster">
                    Register
                </router-link>
        </div>
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
mounted(){
    // window.location.reload();
},
methods:{
    async login(){
        const redirectPath = this.$route.query.redirect
        if(await this.userDatax.loginuser(this.data)){
            if(undefined!=redirectPath){
                this.$router.push(redirectPath)
            }
            else{
                window.location.reload();
                this.$router.push("/myprofile")}
        }
        
             }
        
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

<style scoped>
    .login-container {
      margin-top: 50px;
      margin-bottom: 100px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      min-height: 60vh;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      padding: 2.5rem 2rem 2rem 2rem;
      width: 100%;
      max-width: 500px;
      text-align: center;
      transition: all 0.3s ease, box-shadow 0.4s cubic-bezier(0.4,0,0.2,1);
      position: relative;
      overflow: hidden;
    }
    .login-card:hover {
      box-shadow: 0 0 32px 8px #57cc99, 0 10px 30px rgba(0,0,0,0.18);
    }
    .login-card h2 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      font-weight: 700;
      color: #2c3e50;
    }
    .form-control {
      border-radius: 10px;
      margin-bottom: 1.2rem;
      padding: 0.75rem 1rem;
      font-size: 1rem;
    }
    .btn-login {
      background: linear-gradient(135deg, rgb(212, 216, 213) 0%, rgb(11, 10, 12) 50%);
      color: #fff;
      border: none;
      border-radius: 25px;
      padding: 0.75rem 2rem;
      font-size: 1.1rem;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
      margin-top: 0.5rem;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    .login-icon {
      font-size: 2.5rem;
      color: #57cc99;
      margin-bottom: 1rem;
    }
    .form-group {
      position: relative;
      margin-bottom: 1.7rem;
    }
    .form-group input {
      width: 60%;
      padding: 0.75rem 1rem;
      border-radius: 10px;
      border: 1px solid #ced4da;
      font-size: 1rem;
      color:#000601;
      background: transparent;
      transition: border-color 0.2s;
    }
    .form-group label {
      position: absolute;
      left: 6rem;
      top: 30%;
      transform: translateY(-50%);
      color: #888;
      font-size: 1.2rem;
      pointer-events: none;
      background: transparent;
      transition: 0.2s cubic-bezier(0.4,0,0.2,1);
      padding: 0 0.25rem;
    }
    .form-group input:focus,
    .form-group input:hover {
      border-color: #000601;
      outline: none;
    }
    .form-group input:focus + label,
    .form-group input:hover + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -0.8rem;
      left:6rem;
      font-size: 1rem;
      color:  #000601;
     
      padding: 0 0.3rem;
      z-index: 2;
    }
    @media (max-width: 480px) {
      .login-container {
        margin-top: 120px;
        padding: 1rem;
      }
      .login-card {
        padding: 1.5rem 0.5rem 1.5rem 0.5rem;
      }
    
    }
</style>