<template>
    <div class="permission-denied">
        <h1>Permission Denied</h1>
        <p>
            Your account does not have permission to access this feature.<br>
            Please contact your administrator if you believe this is a mistake.
        </p>
    </div>
</template>

<script>
import axios from 'axios';
import { useUser } from '../../resources/Store/user';
import { useMenus } from '../../resources/Store/menu';
export default{
setup(){
        const userDatax=useUser();
        const menu = useMenus();
        return {userDatax,menu}
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
        },

        menulist(){
            return this.menu.menu
        }
    },

watch:{

    menulist(newvalue){
        const redirectPath = this.$route.query.redirect        
        if(newvalue[0].id){
            if(undefined!=redirectPath){
                this.$router.push(redirectPath)
            }
            else{
                this.$router.push("/myprofile")
            }

        }

    },  


    userData(newvalue){
        const redirectPath = this.$route.query.redirect



        
        if(newvalue.id){
            
            
            
            if(undefined!=redirectPath){
                
                this.$router.push(redirectPath)
                
            }
            else{
                this.$router.push("/myprofile")
            }

        }

    }
}
}
</script>

<style scoped>
.permission-denied {
    max-width: 400px;
    margin: 100px auto;
    padding: 32px;
    border: 1px solid #e57373;
    border-radius: 8px;
    background: #fff3f3;
    text-align: center;
}
.permission-denied h1 {
    color: #d32f2f;
    margin-bottom: 16px;
}
.permission-denied p {
    color: #555;
}
</style>