<template>
    <div class="dashboard">
        <h1>LMS Profile Overview</h1>
        <div class="stats">
            <div class="stat-card">
                <h2>{{ courses.length }}</h2>
                <p>Enrolled Courses</p>
            </div>
            <div class="stat-card">
                <h2>{{ completedCourses }}</h2>
                <p>Completed Courses</p>
            </div>
            <div class="stat-card">
                <h2>{{ progress }}%</h2>
                <p>Overall Progress</p>
            </div>
        </div>
        <div class="courses-list">
            <h3>My Courses</h3>
            <ul>
                <li v-for="course in courses" :key="course.id">
                    <strong>{{ course.name }}</strong> - {{ course.status }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProfileOverview',
    data() {
        return {
            courses: [
                { id: 1, name: 'Mathematics 101', status: 'In Progress' },
                { id: 2, name: 'Physics Basics', status: 'Completed' },
                { id: 3, name: 'Introduction to Programming', status: 'In Progress' }
            ]
        };
    },
    computed: {
        completedCourses() {
            return this.courses.filter(c => c.status === 'Completed').length;
        },
        progress() {
            if (this.courses.length === 0) return 0;
            return Math.round(
                (this.completedCourses / this.courses.length) * 100
            );
        }
    }
};
</script>

<style scoped>
.dashboard {
    max-width: 700px;
    margin: 40px auto;
    padding: 24px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.stats {
    display: flex;
    gap: 24px;
    margin-bottom: 32px;
}
.stat-card {
    flex: 1;
    background: #f5f7fa;
    padding: 16px;
    border-radius: 6px;
    text-align: center;
}
.courses-list ul {
    list-style: none;
    padding: 0;
}
.courses-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}
</style>