<template>
    <div class="teacher">
        <h1>Teacher Details</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="teacher.name" required>
            </div>
            <div>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" v-model="teacher.subject" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="teacher.email" required>
            </div>
            <button @click.prevent="save_teacher()">save</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            teacher: {
                 user_id : "1",
                 rank : "Mr.",
                birthday : null,
                age : 20,
                contact_number : "0916",
                address : "cavite city"
            }
        };
    },
    methods: {

        save_teacher(){
            axios.post('/api/save_teacher', this.teacher)
                .then(response => {
                    console.log('Teacher saved successfully:', response.data);
                    alert('Teacher details saved successfully!');
                    // Reset form
                    this.teacher = { name: '', subject: '', email: '' };
                })
                .catch(error => {
                    console.error('Error saving teacher:', error);
                    alert('Failed to save teacher details.');
                });
        },  
    }
};

</script>