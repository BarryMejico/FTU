<template>
    <div class="course-admin">
        <h1>Course Administration</h1>
        <div class="card-list">
            <!-- <CourseCard/> -->
             <router-view>  </router-view>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import CourseCard from '../cards/cards.vue'

const courses = ref([
    { id: 1, title: 'Mathematics 101', description: 'Basic concepts of mathematics.' },
    { id: 2, title: 'Physics 201', description: 'Introduction to physics principles.' },
    { id: 3, title: 'Chemistry 301', description: 'Advanced chemistry topics.' }
])
</script>

<style scoped>
.course-admin {
    padding: 2rem;
}
.card-list {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}
</style>