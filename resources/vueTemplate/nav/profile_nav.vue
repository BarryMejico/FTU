<template>
    <nav class="profile-nav">
        <ul>
            <li :class="{ active: activeTab === 'details' }" @click="setActive('details')">
                 <router-link to="/userDetails">
                    <span>
                        Details
                    </span>
                    
                </router-link>
            </li>
            <li :class="{ active: activeTab === 'education' }" @click="setActive('education')">
                Education
            </li>
            <li :class="{ active: activeTab === 'courses' }" @click="setActive('courses')">
                Courses
            </li>
        </ul>
    </nav>
    
</template>

<script>
export default {
    name: 'ProfileNav',
    data() {
        return {
            activeTab: 'details'
        }
    },
    methods: {
        setActive(tab) {
            this.activeTab = tab;
            this.$emit('tab-selected', tab);
        }
    }
}
</script>

<style scoped>
.profile-nav ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    background: #f5f5f5;
    border-bottom: 1px solid #ddd;
}

.profile-nav li {
    padding: 1rem 2rem;
    cursor: pointer;
    transition: background 0.2s;
}

.profile-nav li.active {
    background: #fff;
    border-bottom: 2px solid #007bff;
    font-weight: bold;
}

.profile-nav li:not(.active):hover {
    background: #e9ecef;
}
</style>