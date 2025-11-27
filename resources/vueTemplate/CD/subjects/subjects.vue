<template>
    <div>
        <h1>Subjects</h1>
        <form @submit.prevent="addSubject">
            <input v-model="newSubject" placeholder="Add a new subject" />
            <button type="submit">Add Subject</button>
        </form>
        <div class="card-container">
            <div class="card" v-for="subject in subjects" :key="subject.id">
                <h3>{{ subject.name }}</h3>
                <button @click="editSubject(subject)">Edit</button>
                <button @click="deleteSubject(subject.id)">Delete</button>
            </div>
        </div>
        <ul>
            <li v-for="subject in subjects" :key="subject.id">
                {{ subject.name }}
                <button @click="editSubject(subject)">Edit</button>
                <button @click="deleteSubject(subject.id)">Delete</button>
            </li>
        </ul>
        <div v-if="editingSubject">
            <h2>Edit Subject</h2>
            <input v-model="editingSubject.name" />
            <button @click="updateSubject">Update</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            subjects: [],
            newSubject: '',
            editingSubject: null,
        };
    },
    methods: {
        async fetchSubjects() {
            const response = await fetch('api/subjects');
            this.subjects = await response.json();
        },
        async addSubject() {
            const response = await fetch('api/add_subject', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name: this.newSubject }),
            });
            const subject = await response.json();
            this.subjects.push(subject);
            this.newSubject = '';
        },
        async editSubject(subject) {
            this.editingSubject = { ...subject };
        },
        async updateSubject() {
            await fetch(`api/update_subject/${this.editingSubject.id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.editingSubject),
            });
            const index = this.subjects.findIndex(s => s.id === this.editingSubject.id);
            this.subjects.splice(index, 1, this.editingSubject);
            this.editingSubject = null;
        },
        async deleteSubject(id) {
            await fetch(`api/delete_subject/${id}`, { method: 'DELETE' });
            this.subjects = this.subjects.filter(subject => subject.id !== id);
        },
    },
    mounted() {
        this.fetchSubjects();
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>