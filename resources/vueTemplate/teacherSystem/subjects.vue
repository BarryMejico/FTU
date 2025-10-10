<template>
    <div class="subject-list">
        <input
            v-model="search"
            type="text"
            placeholder="Search subjects..."
            class="search-bar"
        />
        <div class="cards">
            <div
                v-for="subject in filteredSubjects"
                :key="subject.code"
                class="card"
            >
                <h3>{{ subject.title }}</h3>
                <p><strong>Code:</strong> {{ subject.code }}</p>
                <p><strong>Duration:</strong> {{ subject.duration }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Subjects",
    data() {
        return {
            search: "",
            subjects: [
                { code: "MATH101", title: "Calculus I", duration: "2 hours" },
                { code: "PHY201", title: "Physics II", duration: "1.5 hours" },
                { code: "ENG301", title: "English Literature", duration: "2 hours" },
                // Add more subjects as needed
            ],
        };
    },
    computed: {
        filteredSubjects() {
            const term = this.search.toLowerCase();
            return this.subjects.filter(
                (s) =>
                    s.code.toLowerCase().includes(term) ||
                    s.title.toLowerCase().includes(term)
            );
        },
    },
};
</script>

<style scoped>
.subject-list {
    max-width: 600px;
    margin: 0 auto;
    padding: 24px;
}
.search-bar {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
}
.cards {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}
.card {
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    padding: 16px;
    width: calc(50% - 8px);
}
.card h3 {
    margin: 0 0 8px 0;
}
</style>