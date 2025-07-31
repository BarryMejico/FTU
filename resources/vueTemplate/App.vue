<template>
  <div class="container mx-auto">
    <div class="grid grid-rows-3">
      <div class="col-span-12"><navigation></navigation> </div>
      <div class="col-span-2"><ToolBar></ToolBar></div>
      <div class="col-span-10"><router-view :key="$route.path"></router-view></div>
      <div class="col-span-12"><myfooter></myfooter></div>
    </div>    
</div>

</template>
<script>
import navigation from './nav/nav.vue'
import myfooter from './myfooter/myfooter.vue'
import { useUser } from '../Store/user';
import ToolBar from './nav/menubar.vue';

export default {
  components:{
    navigation,
    myfooter,
    ToolBar
    
  },

  setup() {
        const userData=useUser();
        return {userData}
   },

   async created(){

   },

   mounted(){
    const userData=useUser();
    userData.logUser()
   },

   methods:{
    async get_logUser(){

    }
   }
}
</script>