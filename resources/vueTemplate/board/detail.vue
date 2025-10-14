<template>
  <div class="board-detail">
    <button @click="$router.back()" class="back">← Back</button>
    <h2>{{ title }}</h2>
    <p>Details for <strong>{{ title }}</strong> (demo). You can replace this with a table or chart.</p>
    <div v-if="loading">Loading...</div>
    <pre v-if="stats">{{ stats }}</pre>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'BoardDetail',
  data(){
    return { stats: null, loading: true }
  },
  computed:{
    key(){ return this.$route.params.key },
    title(){ return this.key ? this.key.replace('_GRADUATED','') : 'Detail' }
  },
  async mounted(){
    try{
      const res = await axios.get('/api/dashboard/enlisted')
      this.stats = res.data
    }catch(e){ this.stats = {error: e.message} }
    finally{ this.loading = false }
  }
}
</script>

<style scoped>
.board-detail{ padding:1rem }
.back{ background:transparent; border:1px solid #e2e8f0; padding:.4rem .6rem; border-radius:6px; cursor:pointer }
</style>