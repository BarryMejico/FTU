<template>
  <div class="auth-overlay">

<form class="modern-form">
  <div class="form-title">Create an Account</div>

  <div class="form-body">
    <div class="input-group">
      <div class="input-wrapper">
        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
          <circle
            stroke-width="1.5"
            stroke="currentColor"
            r="4"
            cy="8"
            cx="12"
          ></circle>
          <path
            stroke-linecap="round"
            stroke-width="1.5"
            stroke="currentColor"
            d="M5 20C5 17.2386 8.13401 15 12 15C15.866 15 19 17.2386 19 20"
          ></path>
        </svg>
        <input
          required=""
          placeholder="Name"
          class="form-input"
          type="text"
          v-model="Data.name"
          />
         <label v-if="err.name">{{ err.name }}<br></label>
      </div>
    </div>

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
          required=""
          placeholder="Email"
          class="form-input"
          type="email"
          v-model="Data.email"
        />
        <label v-if="err.email">{{ err.email }}<br></label>
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
          required=""
          placeholder="Password"
          class="form-input"
          type="password"
          v-model="Data.password"
          />
        <label v-if="err.password">{{ err.password }}<br></label>
    
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
          required=""
          placeholder="Confirm Password"
          class="form-input"
          type="password"
          v-model="Data.password_confirmation"
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

  <button class="submit-button" type="submit" :disabled="submitting" @click.prevent="register()">
    <span class="button-text">{{ submitting ? 'Creating...' : 'Create Account' }}</span>
    <div class="button-glow"></div>
  </button>
  <label class="server-message" v-if="message">{{ message }}</label>
  <label class="client-message" v-if="clientMessage">{{ clientMessage }}</label>
  <div class="confirm-toast" v-if="showConfirm">
    <div class="toast-inner">Registration successful</div>
  </div>

  <div class="form-footer">
    <a class="login-link" href="#">
      Already have an account? <router-link to="/login"><span>Login</span></router-link>
    </a>
  </div>
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
    showConfirm:false,
    clientMessage:'',
    submitting:false,
    }
        
    },

    methods:{
        register(){
      // client-side required checks
      this.clientMessage = '';
      if(!this.Data.name || !this.Data.email || !this.Data.password || !this.Data.password_confirmation){
        this.clientMessage = 'Please fill in all required fields.';
        // keep focus/inputs intact, don't submit
        return;
      }
      // simple password confirmation check
      if(this.Data.password !== this.Data.password_confirmation){
        this.clientMessage = 'Passwords do not match.';
        return;
      }

      this.submitting = true;
      axios.post('/api/register',this.Data)
           .then((response)=>{
        // show server message and a small confirmation toast
        // server may return an object or string
        this.message = (response.data && typeof response.data === 'string') ? response.data : (response.data.message || 'Registered successfully');
        this.showConfirm = true;
        // after confirmation, hide toast and redirect to login page
        setTimeout(()=>{ 
          this.showConfirm = false;
          // navigate to login route
          if(this.$router){
            this.$router.push({ path: '/login' });
          }
        }, 3000);
        console.log(this.message);
        // do not clear data immediately to avoid damaging inputs; only clear on explicit call
           })
           .catch((err)=>{
              // prefer friendly client message and attach field errors if available
              if(err.response && err.response.data){
                if(err.response.data.errors){
                  this.err = err.response.data.errors;
                  // pick first field error message
                  const first = Object.values(err.response.data.errors)[0];
                  this.clientMessage = Array.isArray(first) ? first[0] : first;
                } else if(err.response.data.message){
                  this.clientMessage = err.response.data.message;
                } else {
                  this.clientMessage = 'Registration failed. Please try again.';
                }
              } else {
                this.clientMessage = 'Registration failed. Please check your connection.';
              }
              console.log(err);
           })
           .finally(()=>{
             this.submitting = false;
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

<style>
/* From Uiverse.io by kyle1dev */ 
.modern-form {
  --primary: #00004D;
  --primary-dark: #2563eb;
  --primary-light: rgba(59, 130, 246, 0.1);
  --success: #10b981;
  --text-main: #1e293b;
  --text-secondary: #64748b;
  --bg-input: #f8fafc;
  margin-bottom: 80px;
 
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
.button-glow {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.2),
    transparent
  );
  transform: translateX(-100%);
  transition: transform 0.5s ease;
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

.submit-button:hover {
  background: var(--primary-dark);
  transform: translateY(-1px);
  box-shadow:
    0 4px 12px rgba(59, 130, 246, 0.25),
    0 2px 4px rgba(59, 130, 246, 0.15);
}

.submit-button:hover .button-glow {
  transform: translateX(100%);
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

.password-toggle:active {
  transform: scale(0.9);
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

/* Messages */
.client-message, .server-message{
  display: block;
  margin-top: 8px;
  color: #ef4444;
  font-size: 13px;
}
.server-message{
  color: #065f46; /* success-ish for server text when used for success */
}

/* confirmation toast */
.confirm-toast{
  position: absolute;
  right: 12px;
  top: -8px;
  z-index: 40;
}
.toast-inner{
  background: #10b981;
  color: white;
  padding: 8px 12px;
  border-radius: 8px;
  box-shadow: 0 6px 18px rgba(16,185,129,0.15);
  font-size: 13px;
}

</style>

<style>
/* overlay wrapper for registration when used standalone */
.auth-overlay{
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  background: rgba(0,0,0,0.04);
  z-index: 60;
}
</style>