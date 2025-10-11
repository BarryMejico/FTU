<template>

<!-- From Uiverse.io by kyle1dev --> 
<form class="modern-form">
<div class="login-icon">
            <i class="fas fa-user-circle"></i>
         </div>

  <div class="form-title">Log in</div>

  <div class="form-body">

    <div class="input-group">
      <div class="input-wrapper">
        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
          <path
            stroke-width="1.5"
            stroke="currentColor"
            d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"
          ></path>
        </svg>
        <input
        
          placeholder="Email"
          class="form-input"
          type="email"
           v-model="data.email" required autofocus
        />
      </div>
    </div>

    <div class="input-group">
      <div class="input-wrapper">
        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
          <path
            stroke-width="1.5"
            stroke="currentColor"
            d="M12 10V14M8 6H16C17.1046 6 18 6.89543 18 8V16C18 17.1046 17.1046 18 16 18H8C6.89543 18 6 17.1046 6 16V8C6 6.89543 6.89543 6 8 6Z"
          ></path>
        </svg>
        <input
          
          placeholder="Password"
          class="form-input"
          type="password"
          v-model="data.password" required
        />
        <button class="password-toggle" type="button">
          <svg fill="none" viewBox="0 0 24 24" class="eye-icon">
            <path
              stroke-width="1.5"
              stroke="currentColor"
              d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"
            ></path>
            <circle
              stroke-width="1.5"
              stroke="currentColor"
              r="3"
              cy="12"
              cx="12"
            ></circle>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <button class="submit-button" type="submit"  @click.prevent="login()">
    <span class="button-text">Log in</span>
    <div class="button-glow"></div>
  </button>

  <div class="form-footer">
    <a class="login-link" href="#">
     Don't have an account? <router-link to="/regster"><span>Create Account</span></router-link>
    </a>
  </div>
</form>


  

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
                console.log("")
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

/* From Uiverse.io by kyle1dev */ 
.modern-form {
  --primary: #3b82f6;
  --primary-dark: #2563eb;
  --primary-light: rgba(59, 130, 246, 0.1);
  --success: #10b981;
  --text-main: #1e293b;
  --text-secondary: #64748b;
  --bg-input: #f8fafc;
  margin-bottom: 80px;
  margin-left: 150px;
  margin-top: 10px;

  position: relative;
  width: 300px;
  padding: 24px;
  background: #ffffff;
  border-radius: 16px;
  box-shadow:
    0 4px 6px -1px rgba(0, 0, 0, 0.1),
    0 2px 4px -2px rgba(0, 0, 0, 0.05),
    inset 0 0 0 1px rgba(148, 163, 184, 0.1);
  font-family:
    system-ui,
    -apple-system,
    sans-serif;
}

.form-title {
  font-size: 22px;
  font-weight: 600;
  color: var(--text-main);
  margin: 0 0 24px;
  text-align: center;
  letter-spacing: -0.01em;
}

.input-group {
  margin-bottom: 16px;
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.form-input {
  width: 100%;
  height: 40px;
  padding: 0 36px;
  font-size: 14px;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  background: var(--bg-input);
  color: var(--text-main);
  transition: all 0.2s ease;
}

.form-input::placeholder {
  color: var(--text-secondary);
}

.input-icon {
  position: absolute;
  left: 12px;
  width: 16px;
  height: 16px;
  color: var(--text-secondary);
  pointer-events: none;
}

.password-toggle {
  position: absolute;
  right: 12px;
  display: flex;
  align-items: center;
  padding: 4px;
  background: none;
  border: none;
  color: var(--text-secondary);
  cursor: pointer;
  transition: all 0.2s ease;
}

.eye-icon {
  width: 16px;
  height: 16px;
}

.submit-button {
  position: relative;
  width: 100%;
  height: 40px;
  margin-top: 8px;
  background: var(--primary);
  color: white;
  border: none;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  overflow: hidden;
  transition: all 0.2s ease;
}

button {
 border: none;
 color: #fff;
 background-image: linear-gradient(30deg, #0400ff, #4ce3f7);
 border-radius: 20px;
 background-size: 100% auto;
 font-family: inherit;
 font-size: 17px;
 padding: 0.6em 1.5em;
}

button:hover {
 background-position: right center;
 background-size: 200% auto;
 -webkit-animation: pulse 2s infinite;
 animation: pulse512 1.5s infinite;
}

@keyframes pulse512 {
 0% {
  box-shadow: 0 0 0 0 #05bada66;
 }

 70% {
  box-shadow: 0 0 0 10px rgb(218 103 68 / 0%);
 }

 100% {
  box-shadow: 0 0 0 0 rgb(218 103 68 / 0%);
 }
}

.form-footer {
  margin-top: 16px;
  text-align: center;
  font-size: 13px;
}

.login-link {
  color: var(--text-secondary);
  text-decoration: none;
  transition: all 0.2s ease;
}

.login-link span {
  color: var(--primary);
  font-weight: 500;
}

/* Hover & Focus States */
.form-input:hover {
  border-color: #cbd5e1;
}

.form-input:focus {
  outline: none;
  border-color: var(--primary);
  background: white;
  box-shadow: 0 0 0 4px var(--primary-light);
}

.password-toggle:hover {
  color: var(--primary);
  transform: scale(1.1);
}

.login-link:hover {
  color: var(--text-main);
}

.login-link:hover span {
  color: var(--primary-dark);
}

/* Active States */
.submit-button:active {
  transform: translateY(0);
  box-shadow: none;
}


/* Validation States */
.form-input:not(:placeholder-shown):valid {
  border-color: var(--success);
}

.form-input:not(:placeholder-shown):valid ~ .input-icon {
  color: var(--success);
}

/* Animation */
@keyframes shake {
  0%,
  100% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-4px);
  }
  75% {
    transform: translateX(4px);
  }
}

.form-input:not(:placeholder-shown):invalid {
  border-color: #ef4444;
  animation: shake 0.2s ease-in-out;
}

.form-input:not(:placeholder-shown):invalid ~ .input-icon {
  color: #ef4444;
}
.login-icon {
  font-size: 40px;
  color: var(--primary);
  text-align: center;
  margin-bottom: 10px;
}
</style>