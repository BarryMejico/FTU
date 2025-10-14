<template>
    <div class="teacher-form-container">
        <h1>User / Instructor Details</h1>
        <form @submit.prevent="save_teacher" class="teacher-form">
            <div class="form-group">
                <label for="rank">Rank:</label>
                <select id="rank" v-model="teacher.rank" required>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Prof.">Prof.</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" v-model="teacher.birthday" required>
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" v-model="teacher.age" min="20" max="100" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" id="contact_number" v-model="teacher.contact_number" 
                       pattern="[0-9]{11}" placeholder="09XXXXXXXXX" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" v-model="teacher.address" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" v-model="teacher.gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Save Instructor Details</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            teacher: {
                user_id: "1",
                rank: "Mr.",
                birthday: null,
                age: 20,
                contact_number: "",
                address: "",
                gender: "male"
            }
        };
    },
    methods: {
        save_teacher() {
            axios.post('/api/save_teacher', this.teacher)
                .then(response => {
                    console.log('Teacher saved successfully:', response.data);
                    alert('Teacher details saved successfully!');
                })
                .catch(error => {
                    console.error('Error saving teacher:', error);
                    alert('Failed to save teacher details.');
                });
        },
    }
};
</script>

<style scoped>
.teacher-form-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 0 1rem;
}

h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 2rem;
}

.teacher-form {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-weight: 600;
}

input,
select,
textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
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

.submit-btn {
    width: 100%;
    padding: 1rem;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
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
}
</style>