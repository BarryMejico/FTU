<template>
  <div class="files-page">
    <div class="files-header">
      <div>
        <h1>File Management</h1>
        <p class="subtitle">Manage your document inventory</p>
      </div>

      <div class="actions">
        <button class="btn-upload" @click="openUploadModal">
          <span class="icon">⤴</span>
          Upload File
        </button>
      </div>
    </div>

    <!-- Top stats -->
    <section class="stats-grid">
      <div class="stat-card blue">
        <div class="stat-left">
          <div class="stat-label">Total Files</div>
          <div class="stat-value">{{ totalFiles }}</div>
          <div class="stat-sub">Across all categories</div>
        </div>
        <div class="stat-icon">📁</div>
      </div>

      <div class="stat-card green">
        <div class="stat-left">
          <div class="stat-label">Available</div>
          <div class="stat-value">{{ availableCount }}</div>
          <div class="stat-sub">Ready for checkout</div>
        </div>
        <div class="stat-icon">✅</div>
      </div>

      <div class="stat-card orange">
        <div class="stat-left">
          <div class="stat-label">Checked Out</div>
          <div class="stat-value">{{ checkedOutCount }}</div>
          <div class="stat-sub">Currently in use</div>
        </div>
        <div class="stat-icon">⚠️</div>
      </div>

      <div class="stat-card purple">
        <div class="stat-left">
          <div class="stat-label">Categories</div>
          <div class="stat-value">{{ categoriesCount }}</div>
          <div class="stat-sub">Active categories</div>
        </div>
        <div class="stat-icon">📂</div>
      </div>
    </section>

    <section class="controls">
      <input v-model="query" class="search" placeholder="Search by filename or filing code..." />

      <select v-model="category" class="select">
        <option value="">All Categories</option>
        <option v-for="c in categories" :key="c" :value="c">{{ c }}</option>
      </select>
    </section>

    <section class="card files-card">
      <div class="card-title">
        <div>
          <strong>Files ({{ filteredFiles.length }})</strong>
          <div class="card-sub">All documents in the inventory</div>
        </div>
      </div>

      <div class="table-wrap">
        <table class="files-table">
          <thead>
            <tr>
              <th>Filing Code</th>
              <th>Filename</th>
              <th>Category</th>
              <th>Status</th>
              <th>Location</th>
              <th>Uploaded</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="filteredFiles.length===0">
              <td :colspan="7" class="empty">No files found</td>
            </tr>
            <tr v-for="(f, idx) in filteredFiles" :key="idx">
              <td>{{ f.code }}</td>
              <td>{{ f.name }}</td>
              <td>{{ f.category }}</td>
              <td>{{ f.status }}</td>
              <td>{{ f.location }}</td>
              <td>{{ f.uploaded }}</td>
              <td>
                <a :href="f.url || '#'" target="_blank" class="action">View</a>
                <button class="action danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Charts area -->
    <section class="charts-grid">
      <div class="chart-card">
        <div class="card-title">
          <div>
            <strong>Recent Activity</strong>
            <div class="card-sub">Last 7 days activity overview</div>
          </div>
        </div>
        <div class="chart-body">
          <!-- placeholder: implement chart with Chart.js or similar later -->
          <div class="chart-placeholder">(Chart area)</div>
        </div>
      </div>

      <div class="chart-card">
        <div class="card-title">
          <div>
            <strong>File Status Distribution</strong>
            <div class="card-sub">Current file availability status</div>
          </div>
        </div>
        <div class="chart-body status-list">
          <div v-for="(count, key) in statusCounts" :key="key" class="status-row">
            <div class="status-key">{{ key }}</div>
            <div class="status-count">{{ count }}</div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <!-- Upload Modal -->
    <div v-if="showUpload" class="modal-backdrop" @click.self="closeUpload">
      <div class="modal">
        <header class="modal-header">
          <h3>Upload File</h3>
          <button class="modal-close" @click="closeUpload" aria-label="Close">×</button>
        </header>

        <form class="modal-body" @submit.prevent="submitUpload" novalidate>
          <div class="form-row">
            <label class="form-label">File</label>
            <input type="file" @change="onFileSelected" aria-describedby="fileHelp" />
            <div v-if="errors.file" class="error">{{ errors.file }}</div>
            <div id="fileHelp" class="sr-only">Accepted: PDF, DOCX, XLSX</div>
          </div>

          <div class="form-row">
            <label class="form-label">Category</label>
            <select v-model="uploadForm.category">
              <option value="">Select category</option>
              <option v-for="c in categories" :key="c" :value="c">{{ c }}</option>
            </select>
            <div v-if="errors.category" class="error">{{ errors.category }}</div>
          </div>

          <div class="form-row">
            <label class="form-label">Location</label>
            <input v-model="uploadForm.location" placeholder="Filing location or shelf" />
          </div>

          <div class="form-row">
            <label class="form-label">Description</label>
            <textarea v-model="uploadForm.description" rows="3" placeholder="Optional description"></textarea>
          </div>

          <div class="modal-actions">
            <button type="submit" class="btn-upload">Upload</button>
            <button type="button" class="action" @click="closeUpload">Cancel</button>
          </div>
        </form>
      </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'FilesView',
  data() {
    return {
      query: '',
      category: '',
      categories: ['Administrative', 'Personnel', 'Finance', 'Training'],
      files: [],
      showUpload: false,
      uploadForm: { file: null, category: '', location: '', description: '' },
      errors: {},
    }
  },
  mounted(){
    this.fetchFiles()
  },
  computed: {
    filteredFiles() {
      let list = this.files
      if (this.query) {
        const q = this.query.toLowerCase()
        list = list.filter(f => (f.name || '').toLowerCase().includes(q) || (f.code || '').toLowerCase().includes(q))
      }
      if (this.category) list = list.filter(f => f.category === this.category)
      return list
    }
    ,
    totalFiles(){
      return this.files.length
    },
    availableCount(){
      return this.files.filter(f => (f.status || 'Uploaded').toLowerCase() === 'available' || (f.available === true)).length
    },
    checkedOutCount(){
      return this.files.filter(f => (f.status || '').toLowerCase() === 'checked out' || (f.checked_out === true)).length
    },
    categoriesCount(){
      const set = new Set(this.files.map(f => (f.category||'').toLowerCase()).filter(Boolean))
      return set.size
    },
    statusCounts(){
      return this.files.reduce((acc, f) => {
        const k = (f.status || 'Uploaded')
        acc[k] = (acc[k] || 0) + 1
        return acc
      }, {})
    }
  },
  methods: {
    fetchFiles(){
      axios.get('/api/files').then(res => {
        this.files = res.data.map(f => ({ code: 'N/A', name: f.name, category: f.category || '', status: 'Uploaded', location: f.path || '', url: f.url || '', uploaded: f.uploaded || '', size: f.size || 0 }))
      }).catch(()=>{ this.files = [] })
    },
    openUploadModal(){
      this.showUpload = true
      this.errors = {}
      this.uploadForm = { file:null, category:'', location:'', description:'' }
    },
    closeUpload(){
      this.showUpload = false
    },
    onFileSelected(evt){
      const input = evt.target
      if (!input.files || input.files.length === 0) {
        this.uploadForm.file = null
        return
      }
      this.uploadForm.file = input.files[0]
    },
    submitUpload(){
      this.errors = {}
      // basic validation
      if (!this.uploadForm.file) this.errors.file = 'Please choose a file.'
      if (!this.uploadForm.category) this.errors.category = 'Please select a category.'
      if (Object.keys(this.errors).length) return

      const allowed = ['application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
      if (!allowed.includes(this.uploadForm.file.type)) {
        this.errors.file = 'Only PDF, DOCX, XLSX files allowed.'
        return
      }

      const fd = new FormData()
      fd.append('file', this.uploadForm.file)
      fd.append('category', this.uploadForm.category)
      fd.append('location', this.uploadForm.location)
      fd.append('description', this.uploadForm.description)

      axios.post('/api/files', fd).then(() => {
        this.fetchFiles()
        this.closeUpload()
      }).catch(err => {
        console.error(err)
        this.errors.file = 'Upload failed'
      })
    }
  }
}
</script>

<style scoped>
.files-page{ padding: 1.25rem }
.files-header{ display:flex; justify-content:space-between; align-items:flex-start; gap:1rem }
.files-header h1{ margin:0; font-size:2rem }
.subtitle{ margin:0; color:#6b7280 }
.actions{ display:flex; align-items:center }
.btn-upload{ background:linear-gradient(90deg,#4f46e5,#06b6d4); color:#fff; border:none; padding:.6rem 1rem; border-radius:10px; box-shadow:0 6px 18px rgba(2,12,30,0.08); cursor:pointer }
.btn-upload .icon{ margin-right:.5rem }

.controls{ display:flex; gap:1rem; margin:1rem 0; align-items:center }
.search{ flex:1; padding:.8rem 1rem; border-radius:10px; border:1px solid #e6eef6; background:#fff }
.select{ padding:.7rem 1rem; border-radius:10px; border:1px solid #e6eef6; background:#fff }

.files-card{ background:#fff; border-radius:12px; padding:1rem; box-shadow: 0 6px 18px rgba(2,12,30,0.04) }
.card-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem }
.card-sub{ color:#6b7280; font-size:.95rem }
.table-wrap{ overflow:auto }
.files-table{ width:100%; border-collapse:collapse; min-width:900px }
.files-table th, .files-table td{ padding:1rem .8rem; text-align:left; border-bottom:1px solid #eef2f7 }
.files-table thead th{ background:transparent; color:#94a3b8; font-weight:600 }
.files-table .empty{ text-align:center; color:#94a3b8; padding:3.5rem 0 }
.action{ padding:.35rem .6rem; border-radius:8px; border:1px solid #e6eef6; background:transparent; cursor:pointer; margin-right:.4rem }
.action.danger{ border-color:#fca5a5; color:#b91c1c }

@media (max-width:900px){
  .files-header{ flex-direction:column; align-items:flex-start }
  .controls{ flex-direction:column }
  .files-table{ min-width:700px }
}

.sr-only{ position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); border:0 }

/* Modal styles */
/* Modal Neat Design */
.modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(2, 6, 23, 0.45);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 60;
}
.modal {
  background: #fff;
  border-radius: 16px;
  width: 420px;
  max-width: 95%;
  box-shadow: 0 12px 40px rgba(2,12,30,0.18);
  overflow: hidden;
  font-family: 'Inter', Arial, sans-serif;
}
.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid #eef2f7;
}
.modal-header h3 {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0;
}
.modal-close {
  background: transparent;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: #888;
  transition: color 0.2s;
}
.modal-close:hover {
  color: #3498db;
}
.modal-body {
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
.form-row {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  margin-bottom: 1rem;
}
.form-label {
  font-weight: 500;
  color: #222;
  margin-bottom: 0.25rem;
}
.modal-body input[type="file"],
.modal-body input,
.modal-body select,
.modal-body textarea {
  width: 100%;
  padding: 0.75rem;
  border: 1.5px solid #e5e7eb;
  border-radius: 8px;
  font-size: 1rem;
  background: #fafbfc;
  transition: border-color 0.2s;
}
.modal-body input:focus,
.modal-body select:focus,
.modal-body textarea:focus {
  border-color: #3498db;
  outline: none;
}
.modal-actions {
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
  padding: 1rem 1.5rem;
  border-top: 1px solid #eef2f7;
}
.modal-actions .btn-upload {
  background: linear-gradient(90deg, #3498db 0%, #00c6fb 100%);
  color: #fff;
  padding: 0.75rem 2rem;
  border-radius: 8px;
  border: none;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}
.modal-actions .btn-upload:hover {
  background: linear-gradient(90deg, #217dbb 0%, #0096c7 100%);
}
.modal-actions .action {
  background: #f5f5f5;
  color: #222;
  border: 1px solid #e5e7eb;
  padding: 0.75rem 2rem;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}
.modal-actions .action:hover {
  background: #e5e7eb;
}
.error {
  color: #dc2626;
  font-size: 0.95rem;
  margin-top: 0.25rem;
}

/* Stats grid */
.stats-grid{ display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin:1.25rem 0 }
.stat-card{ background:#fff; border-radius:10px; padding:1rem 1rem; display:flex; align-items:center; justify-content:space-between; box-shadow:0 6px 18px rgba(2,12,30,0.04) }
.stat-left{ display:flex; flex-direction:column }
.stat-label{ color:#475569; font-weight:600 }
.stat-value{ font-size:1.6rem; font-weight:700; margin:.5rem 0 }
.stat-sub{ color:#94a3b8 }
.stat-icon{ font-size:1.6rem; opacity:.9 }
.stat-card.blue{ border-left:4px solid #3b82f6 }
.stat-card.green{ border-left:4px solid #10b981 }
.stat-card.orange{ border-left:4px solid #f59e0b }
.stat-card.purple{ border-left:4px solid #8b5cf6 }

/* Charts grid */
.charts-grid{ display:grid; grid-template-columns:2fr 1fr; gap:1rem; margin-top:1.25rem }
.chart-card{ background:#fff; border-radius:10px; padding:0; box-shadow:0 6px 18px rgba(2,12,30,0.04); overflow:hidden }
.chart-body{ padding:1rem }
.chart-placeholder{ height:220px; border:1px dashed #e6eef6; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#94a3b8 }
.status-list{ display:flex; flex-direction:column; gap:.5rem; padding:1rem }
.status-row{ display:flex; justify-content:space-between; padding:.6rem .75rem; border-radius:8px; background:#fafafa }
.status-key{ color:#475569 }
.status-count{ font-weight:700 }

@media (max-width:900px){
  .stats-grid{ grid-template-columns:1fr }
  .charts-grid{ grid-template-columns:1fr }
}

</style>