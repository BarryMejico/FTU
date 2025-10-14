<template>
    <div class="courses-container">
        <!-- Header -->
        <div class="header">
            <h2>Courses Management</h2>
            <button class="btn btn-primary" @click="openAddModal">Add New Course</button>
        </div>

        <!-- Courses List -->
        <div class="courses-list">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Credits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in courses" :key="course.id">
                        <td>{{ course.Course_Code }}</td>
                        <td>{{ course.Course_Name }}</td>
                        <td>{{ course.Course_Description }}</td>
                        <td>{{ course.Course_Level }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" @click="editCourse(course)">Edit</button>
                            <button type="button" class="btn btn-success" @click="Subjects(course)">Subjects</button>
                            <button class="btn btn-sm btn-danger" @click="deleteCourse(course.Course_Code)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Modal -->
        <div class="modal" v-if="showModal">
            <div class="modal-content">
                <h3>{{ isEditing ? 'Edit Course' : 'Add New Course' }}</h3>
                <form @submit.prevent="saveCourse">
                    <div class="form-group">
                        <label>Course Name:</label>
                        <input type="text" v-model="currentCourse.Course_Name" required>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea v-model="currentCourse.Course_Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Credits:</label>
                        <input type="number" v-model="currentCourse.Course_Level" required>
                    </div>
                    <div class="modal-buttons">
                        <button type="submit" class="btn btn-success">Save</button>
                        
                        <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Courses',
    data() {
        return {
            courses: [],
            showModal: false,
            isEditing: false,
            currentCourse: {
                id: null,
                name: '',
                description: '',
                credits: 0
            }
        }
    },
    methods: {
        Subjects(course) {
            // this.$router.push({ path: '/subjects', query: { course_code: course.Course_Code } });
        },

        async fetchCourses() {
            try {
                // Replace with your API endpoint
                const response = await axios.get('/api/courses')
                this.courses = response.data
            } catch (error) {
                console.error('Error fetching courses:', error)
            }
        },
        openAddModal() {
            this.isEditing = false
            this.currentCourse = {
                id: null,
                name: '',
                description: '',
                credits: 0
            }
            this.showModal = true
        },
        editCourse(course) {
            this.isEditing = true
            this.currentCourse = { ...course }
            this.showModal = true
        },
        async saveCourse() {
            try {
                if (this.isEditing) {
                    await axios.put(`/api/update_course/${this.currentCourse.Course_Code}`, this.currentCourse)
                } else {
                    await axios.post('/api/add_course', this.currentCourse)
                }
                this.fetchCourses()
                this.closeModal()
            } catch (error) {
                console.error('Error saving course:', error)
            }
        },
        async deleteCourse(id) {
            if (confirm('Are you sure you want to delete this course?')) {
                try {
                    await axios.delete(`/api/delete_course/${id}`)
                    this.fetchCourses()
                } catch (error) {
                    console.error('Error deleting course:', error)
                }
            }
        },
        closeModal() {
            this.showModal = false
            this.currentCourse = {
                id: null,
                name: '',
                description: '',
                credits: 0
            }
        }
    },
    mounted() {
        this.fetchCourses()
    }
}
</script>

<style scoped>
.courses-container {
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 500px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px;
}

.modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-info {
    background: #17a2b8;
    color: white;
    margin-right: 5px;
}

.btn-danger {
    background: #dc3545;
    color: white;
}

.btn-success {
    background: #28a745;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}
</style>