<template>
    <div class="teacher-form-container">
        <h1>Add Teacher</h1>
        <form @submit.prevent="save_teacher" class="teacher-form">
            <h2 class="section-title">I. Instructors Information</h2>
            <div class="form-group">
                <label for="index_number">Index Number</label>
                <input type="text" id="index_number" v-model="teacher.index_number" placeholder="Enter index number" required>
            </div>

            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" v-model="teacher.full_name" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label for="name_with_initials">Name With Initials</label>
                <input type="text" id="name_with_initials" v-model="teacher.name_with_initials" placeholder="Enter name with initials" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" v-model="teacher.address" placeholder="Enter address" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" v-model="teacher.gender" required>
                    <option value="" disabled>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" v-model="teacher.phone_number" placeholder="123-456-7890" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" v-model="teacher.email" placeholder="Enter valid email address" required>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <div class="photo-upload">
                    <input type="file" id="photo" @change="onPhotoChange" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label for="educational_background">Educational Background</label>
                <textarea id="educational_background" v-model="teacher.educational_background" rows="3" placeholder="Enter educational background (e.g., BS Marine Engineering, University of X, 2010)" required></textarea>
            </div>

            <h2 class="section-title">II. Trainings/Seminar/Workshop</h2>
            <div class="form-group checkbox-group">
                <label class="checkbox-item">
                    <input type="checkbox" v-model="teacher.training_pn_instructor_course">
                    <span class="checkbox-label">Philippine Navy Instructor Course</span>
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" v-model="teacher.training_course_director_course">
                    <span class="checkbox-label">Course Director Course</span>
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" v-model="teacher.training_curriculum_development_course">
                    <span class="checkbox-label">Curriculum Development Course</span>
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" v-model="teacher.training_doctrine_writing_course">
                    <span class="checkbox-label">Doctrine Writing Course</span>
                </label>
            </div>

            <div class="additional-trainings">
                <h3 class="subsection-title">Additional Trainings/Seminars</h3>
                <div v-for="(training, index) in additionalTrainings" :key="index" class="training-entry">
                    <div class="training-fields">
                        <div class="form-group">
                            <label :for="'training_name_' + index">Training/Seminar Name</label>
                            <input 
                                type="text" 
                                :id="'training_name_' + index" 
                                v-model="training.name" 
                                placeholder="e.g., Leadership Training"
                            >
                        </div>
                        <div class="training-row">
                            <div class="form-group">
                                <label :for="'training_date_' + index">Date Completed</label>
                                <input 
                                    type="date" 
                                    :id="'training_date_' + index" 
                                    v-model="training.date_completed"
                                >
                            </div>
                            <div class="form-group">
                                <label :for="'training_institution_' + index">Institution/Provider</label>
                                <input 
                                    type="text" 
                                    :id="'training_institution_' + index" 
                                    v-model="training.institution" 
                                    placeholder="e.g., Philippine Navy"
                                >
                            </div>
                        </div>
                        <button type="button" class="remove-btn" @click="removeTraining(index)" v-if="additionalTrainings.length > 1">
                            <i class="ri-delete-bin-line"></i> Remove
                        </button>
                    </div>
                </div>
                <button type="button" class="add-btn" @click="addTraining">
                    <i class="ri-add-line"></i> Add Another Training
                </button>
            </div>

            <h2 class="section-title">III. Military Background</h2>
            <div class="form-group">
                <label for="service_entered">Service Entered</label>
                <input type="date" id="service_entered" v-model="teacher.service_entered" placeholder="Date entered military service">
            </div>

            <div class="form-group">
                <label for="unit_assignment">Unit Assignment</label>
                <input type="text" id="unit_assignment" v-model="teacher.unit_assignment" placeholder="Enter unit assignment">
            </div>

            <div class="form-group">
                <label for="military_schooling">Schooling</label>
                <textarea id="military_schooling" v-model="teacher.military_schooling" rows="3" placeholder="Enter military schooling/courses attended"></textarea>
            </div>

            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" id="designation" v-model="teacher.designation" placeholder="Enter current designation/rank">
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            teacher: {
                index_number: "",
                full_name: "",
                name_with_initials: "",
                address: "",
                gender: "",
                phone_number: "",
                email: "",
                photo: null,
                educational_background: "",
                // trainings
                training_pn_instructor_course: false,
                training_course_director_course: false,
                training_curriculum_development_course: false,
                training_doctrine_writing_course: false,
                // military background
                service_entered: "",
                unit_assignment: "",
                military_schooling: "",
                designation: ""
            },
            additionalTrainings: [
                { name: '', date_completed: '', institution: '' }
            ]
        };
    },
    methods: {
        onPhotoChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.teacher.photo = file;
            }
        },
        addTraining() {
            this.additionalTrainings.push({ name: '', date_completed: '', institution: '' });
        },
        removeTraining(index) {
            this.additionalTrainings.splice(index, 1);
        },
        save_teacher() {
            const formData = new FormData();
            for (const key in this.teacher) {
                if (this.teacher[key] !== null) {
                    // convert booleans to 1/0 for backend if needed
                    const val = typeof this.teacher[key] === 'boolean' ? (this.teacher[key] ? 1 : 0) : this.teacher[key];
                    formData.append(key, val);
                }
            }
            
            // Add additional trainings as JSON
            formData.append('additional_trainings', JSON.stringify(this.additionalTrainings));
            
            axios.post('/api/save_teacher', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    console.log('Teacher saved successfully:', response.data);
                    alert('Teacher details saved successfully!');
                    this.resetForm();
                })
                .catch(error => {
                    console.error('Error saving teacher:', error);
                    alert('Failed to save teacher details.');
                });
        },
        resetForm() {
            this.teacher = {
                index_number: "",
                full_name: "",
                name_with_initials: "",
                address: "",
                gender: "",
                phone_number: "",
                email: "",
                photo: null,
                educational_background: "",
                training_pn_instructor_course: false,
                training_course_director_course: false,
                training_curriculum_development_course: false,
                training_doctrine_writing_course: false,
                service_entered: "",
                unit_assignment: "",
                military_schooling: "",
                designation: ""
            };
            this.additionalTrainings = [
                { name: '', date_completed: '', institution: '' }
            ];
            document.getElementById('photo').value = '';
        }
    }
};
</script>

<style scoped>
.teacher-form-container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
}

h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 2rem;
    font-size: 1.8rem;
    font-weight: 600;
}

.teacher-form {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.section-title {
    margin: 1.5rem 0 1rem;
    font-size: 1.2rem;
    color: #34495e;
    border-left: 4px solid #3498db;
    padding-left: 0.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-weight: 600;
    font-size: 0.95rem;
}

input,
select,
textarea {
    width: 95%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

input::placeholder {
    color: #999;
}

.photo-upload {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 0.5rem;
    background-color: #fafafa;
}

.checkbox-group {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

.checkbox-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.2rem;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 0.2rem;
    padding-right: 1rem;
    min-height: 50px;
    text-align: center;
    white-space: nowrap;
}

.checkbox-label {
    padding-right: 0.75rem;
}

@media (max-width: 600px) {
    .checkbox-group {
        grid-template-columns: 1fr;
    }
    .checkbox-item {
        justify-content: flex-start;
    }
}

input[type="file"] {
    border: none;
    padding: 0.5rem 0;
    background: transparent;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

.additional-trainings {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px solid #e5e7eb;
}

.subsection-title {
    font-size: 1.1rem;
    color: #34495e;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.training-entry {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid #e5e7eb;
    position: relative;
}

.training-fields {
    display: grid;
    gap: 1rem;
}

.training-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.button-row {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.add-btn {
    width: 100%;
    padding: 0.75rem;
    background-color: #27ae60;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

.add-btn:hover {
    background-color: #229954;
}

.remove-btn {
    padding: 0.5rem 1rem;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.remove-btn:hover {
    background-color: #c0392b;
}

.submit-btn {
    width: 100%;
    padding: 1rem;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 2rem;
}

.submit-btn:hover {
    background-color: #2980b9;
}

@media (max-width: 768px) {
    .teacher-form {
        padding: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    input,
    select,
    textarea {
        padding: 0.5rem;
    }
    
    .training-row {
        grid-template-columns: 1fr;
    }
}
</style>