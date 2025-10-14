<template>
    <div class="dashboard">
    <h1>Instructor MLS Dashboard</h1>
        <div class="stats">
            <div class="card">
                <h2>My Classes</h2>
                <p>{{ classesCount }}</p>
            </div>
            <div class="card">
                <h2>Assignments</h2>
                <p>{{ assignmentsCount }}</p>
            </div>
            <div class="card">
                <h2>Students</h2>
                <p>{{ studentsCount }}</p>
            </div>
        </div>
        <div class="recent">
            <h2>Recent Activities</h2>
            <ul>
                <li v-for="activity in recentActivities" :key="activity.id">
                    {{ activity.text }}
                </li>
            </ul>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'TeacherDashboard',
    data() {
        return {
            classesCount: 5,
            assignmentsCount: 12,
            studentsCount: 120,
            recentActivities: [
                { id: 1, text: 'Graded Assignment 3 for Math 101' },
                { id: 2, text: 'Posted new assignment for Physics 201' },
                { id: 3, text: 'Updated attendance for Chemistry 102' },
            ],
        };
    },
};
</script>

<style scoped>
.dashboard {
    max-width: 900px;
    margin: 0 auto;
    padding: 32px;
}
.stats {
    display: flex;
    gap: 24px;
    margin-bottom: 32px;
}
.card {
    background: #f5f5f5;
    padding: 24px;
    border-radius: 8px;
    flex: 1;
    text-align: center;
}
.recent ul {
    list-style: none;
    padding: 0;
}
.recent li {
    background: #e9ecef;
    margin-bottom: 8px;
    padding: 12px;
    border-radius: 4px;
}
</style>