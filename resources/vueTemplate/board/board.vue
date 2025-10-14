<template>
  <div class="board-page" :class="{ 'centered-content': isSidebarCollapsed }">
    <h1>Monitoring</h1>

    <div class="cards" role="list">
      <router-link
        v-for="stat in statsOrder"
        :key="stat.key"
        :to="{ name: 'dashboard-detail', params: { key: stat.key } }"
        class="card-link"
      >
        <div class="card" :title="stat.label" :data-accent="stat.accent || ''">
          <div class="card-body">
            <div class="card-icon" :aria-hidden="true">
              <i :class="stat.icon || 'ri-bar-chart-line'"></i>
            </div>

            <div class="card-content">
              <div class="card-value" aria-live="polite">
                <template v-if="loading">• • •</template>
                <template v-else-if="error">Error</template>
                <template v-else>{{ stats[stat.key] ?? 0 }}</template>
              </div>
              <div class="card-title">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </router-link>
    </div>

    <div v-if="error" class="error">{{ error }}</div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { useUi } from '../../Store/ui'

const stats = ref({})
const loading = ref(true)
const error = ref(null)
const statsOrder = [
  { key: 'DKBSC_GRADUATED', label: 'DKBSC', icon: 'ri-user-star-line', accent: '#0ea5b3' },
  { key: 'DKASC_GRADUATED', label: 'DKASC', icon: 'ri-user-3-line', accent: '#6366f1' },
  { key: 'DKSMC_GRADUATED', label: 'DKSMC', icon: 'ri-shield-star-line', accent: '#f97316' },
  { key: 'BBFFOC_GRADUATED', label: 'BBFFOC', icon: 'ri-medal-line', accent: '#ef4444' },
  { key: 'ABFFOC_GRADUATED', label: 'ABFFOC', icon: 'ri-award-line', accent: '#10b981' },
]

const ui = useUi()
const isSidebarCollapsed = computed(() => ui.sidebarCollapsed)

async function fetchStats() {
  loading.value = true
  error.value = null
  try {
    const res = await axios.get('/api/dashboard/enlisted')
    stats.value = res.data
  } catch (e) {
    error.value = e.response && e.response.data && e.response.data.message ? e.response.data.message : e.message
  } finally {
    loading.value = false
  }
}

onMounted(fetchStats)
</script>

<style scoped>
.board-page {
  padding: 1rem;
  max-width: 1100px;
  margin: 0 auto;
}
.centered-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 1rem;
  margin-top: 1rem;
  width: 100%;
}
.card-link{ text-decoration:none; color:inherit; display:block }
.card {
  background: linear-gradient(180deg,#fff,#f7fbff);
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(20,30,60,0.06);
  padding: 1rem;
  display:flex;
  align-items:center;
  justify-content:center;
  transition: transform .16s ease, box-shadow .16s ease;
  will-change: transform;
}
.card:hover{ transform: translateY(-6px) scale(1.02); box-shadow: 0 18px 34px rgba(2,12,30,0.12) }
.card-body{ display:flex; align-items:center; gap:1rem; justify-content:center }
.card-icon{ width:56px; height:56px; display:inline-flex; align-items:center; justify-content:center; background:linear-gradient(180deg,#e6f3ff,#d9eefb); color:#0369a1; font-size:20px; flex:0 0 56px; border-radius:999px }
.card-content{ display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center }
.card-value { font-size:2rem; font-weight:700; color:#0f172a; line-height:1; font-feature-settings: 'tnum'; font-variant-numeric: tabular-nums; min-width:60px; text-align:center }
.card-title { color:#6b7280; font-weight:600; margin-top:6px; font-size:1.1rem }
.error { color: #b91c1c; margin-top: 1rem }

.card[data-accent] .card-icon{ box-shadow: 0 6px 10px rgba(2,12,30,0.04) }
.card[data-accent="#0ea5b3"] .card-icon{ background: linear-gradient(180deg,#dff7fa,#d0f0f2); color:#0ea5b3 }
.card[data-accent="#6366f1"] .card-icon{ background: linear-gradient(180deg,#eef0ff,#e6e9ff); color:#6366f1 }
.card[data-accent="#f97316"] .card-icon{ background: linear-gradient(180deg,#fff3ed,#fff1e6); color:#f97316 }
.card[data-accent="#ef4444"] .card-icon{ background: linear-gradient(180deg,#fff2f2,#ffeaea); color:#ef4444 }
.card[data-accent="#10b981"] .card-icon{ background: linear-gradient(180deg,#ecfdf5,#e6fbef); color:#10b981 }
.card[title]:hover{ cursor:pointer }

/* Responsive: stack icon above value on narrow screens */
@media (max-width: 520px) {
  .cards { grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); }
  .card { padding: 0.85rem }
  .card-body { flex-direction: column; gap: 0.5rem }
  .card-icon { width:56px; height:56px; flex:0 0 auto }
  .card-content { align-items:center; text-align:center }
  .card-value { font-size:1.6rem }
  .card-title { font-size:0.95rem }
}
</style>
