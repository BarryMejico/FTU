<template>
    <div class="student">
        <h1>Student Details</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="student.name" required>
            </div>
            <div>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" v-model="student.subject" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="student.email" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            student: {
                name: '',
                subject: '',
                email: ''
            }
        };
    },
    methods: {
        submitForm() {
            // Here you would typically send the data to your backend
            console.log('Student Data:', this.student);
            alert('Student details submitted successfully!');
            // Reset form
            this.student = { name: '', subject: '', email: '' };
        }
    }
};
</script>