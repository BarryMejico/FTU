<template>
    <div>
        <h1>Profile</h1>
        <label><b>Name:</b> </label>
        <span>{{ profileID.name }}</span>
        
    </div>
</template>
<script>
import axios from 'axios';

export default{
    data(){
        return({
            profileID:'s',
        })
    },



    async created(){
        await axios
                .get('/api/thatProfile',{params:{id:this.$route.params.id}})
                .then((res)=>{
                    console.log(res.data)
                    this.profileID=res.data[0]
                                    })
    }
}
</script>