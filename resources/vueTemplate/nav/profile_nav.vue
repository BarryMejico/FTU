<template>
    <nav class="profile-nav">
        <ul>
            <li :class="{ active: activeTab === 'dashboard' }" @click="setActive('dashboard')">
                        Dashboard
            </li>
            <li :class="{ active: activeTab === 'details' }" @click="setActive('details')">
                        Details
            </li>
            <li :class="{ active: activeTab === 'education' }" @click="setActive('education')">
                Education
            </li>
            
        </ul>
    </nav>
    
</template>

<script>
export default {
    name: 'ProfileNav',
    data() {
        return {
            activeTab: 'dashboard'
        }
    },
    methods: {
        setActive(tab) {
            this.activeTab = tab;
            

            if(tab=='dashboard'){
                this.$router.push("/myDashboard");
                this.$emit('tab-selected', 'dashboard');
            }
            if(tab=='details'){
                this.$router.push("/userDetails");
                this.$emit('tab-selected', 'details');
            }
            if(tab=='education'){
                this.$router.push("/userEducation");
                this.$emit('tab-selected', 'education');
            }
            if(tab=='courses'){ 
                this.$router.push("/userCourses");
                this.$emit('tab-selected', 'courses');
            }
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