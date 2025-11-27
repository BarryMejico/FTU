<template>
    <div class="modules-container">
        <!-- Cards grid -->
        <div class="modules-cards" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;margin-bottom:20px;">
            <div v-for="module in modules" :key="module.id" class="module-card" style="border:1px solid #e6e6e6;border-radius:8px;padding:14px;box-shadow:0 2px 6px rgba(0,0,0,0.04);display:flex;flex-direction:column;justify-content:space-between;min-height:110px;background:#fff;">
                <div>
                    <h3 style="margin:0 0 8px;font-size:16px;color:#333;">{{ module.Module_Name }}</h3>
                    <p style="margin:0;font-size:13px;color:#666;">ID: {{ module.id }}</p>
                </div>
                <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px;">
                    <button @click="openSubjects(module)" style="padding:6px 10px;border:1px solid #4caf50;background:#fff;color:#4caf50;border-radius:4px;cursor:pointer;">Subjects</button>
                    <button @click="editModule(module)" style="padding:6px 10px;border:none;background:#1976d2;color:#fff;border-radius:4px;cursor:pointer;">Edit</button>
                    <button @click="deleteModule(module.id)" style="padding:6px 10px;border:1px solid #e53935;background:#fff;color:#e53935;border-radius:4px;cursor:pointer;">Delete</button>
                </div>
            </div>
        </div>
 

        <!-- Add/Edit Form -->
        <div class="module-form">
            <input v-model="currentModule.Module_Name" placeholder="Module Name">
            <button v-if="isEditing" @click="updateModule">Update Module</button>
            <button v-else @click="createModule">Add Module</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modules',
    data() {
        return {
            modules: [],
            currentModule: {
                id: null,
                Module_Name: ''
            },
            isEditing: false
        }
    },
    methods: {
        // Create
        async createModule() {
            try {
                // Replace with your API endpoint
                const response = await axios.post('/api/add_module', this.currentModule)
                this.modules.push(response.data)
                this.resetForm()
            } catch (error) {
                // console.error('Error creating module:', error)
            }
        },

        // Read
        async fetchModules() {
            try {
                // Replace with your API endpoint
                const response = await axios.get('/api/modules')
                this.modules = response.data
            } catch (error) {
                // console.error('Error fetching modules:', error)
            }
        },

        // Update
        async updateModule() {
            try {
                // Replace with your API endpoint
                const response = await axios.put(
                    `/api/update_module/${this.currentModule.id}`,
                    this.currentModule
                )
                const index = this.modules.findIndex(m => m.id === this.currentModule.id)
                this.modules[index] = response.data
                this.resetForm()
            } catch (error) {
                console.error('Error updating module:', error)
            }
        },

        // Delete
        async deleteModule(id) {
            try {
                // Replace with your API endpoint
                await axios.delete(`/api/delete_module/${id}`)
                this.modules = this.modules.filter(m => m.id !== id)
            } catch (error) {
                console.error('Error deleting module:', error)
            }
        },

        // Utility functions
        editModule(module) {
            this.currentModule = { ...module }
            this.isEditing = true
        },

        resetForm() {
            this.currentModule = {
                id: null,
                name: ''
            }
            this.isEditing = false
        }
    },
    mounted() {
        this.fetchModules()
    }
}
</script>

<style scoped>
.modules-container {
    padding: 20px;
}

.modules-list {
    margin-bottom: 20px;
}

.module-item {
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ddd;
}

.module-form {
    display: flex;
    gap: 10px;
}
</style>