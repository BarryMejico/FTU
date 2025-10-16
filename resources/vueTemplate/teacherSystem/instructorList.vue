<template>
  <div class="instructor-list-container">
    <h2>Instructor List</h2>
    
    <!-- Search Input -->
    <div class="search-section">
      <input 
        v-model="searchQuery" 
        type="text" 
        placeholder="Search by name, index number, or email..." 
        class="search-input"
      />
    </div>

    <!-- Instructors List -->
    <div v-if="filteredInstructors.length > 0" class="instructors-grid">
      <div v-for="instructor in filteredInstructors" :key="instructor.id" class="instructor-card">
        <div class="instructor-header">
          <div class="instructor-photo">
            <img :src="instructor.photo || '/storage/Default.png'" alt="Instructor Photo" />
          </div>
          <div class="instructor-info">
            <h3>{{ instructor.full_name }}</h3>
            <p class="initials">{{ instructor.name_with_initials }}</p>
            <p class="index-number">Index: {{ instructor.index_number }}</p>
          </div>
        </div>
        
        <div class="instructor-details">
          <div class="detail-item">
            <i class="ri-mail-line"></i>
            <span>{{ instructor.email }}</span>
          </div>
          <div class="detail-item">
            <i class="ri-phone-line"></i>
            <span>{{ instructor.phone_number }}</span>
          </div>
          <div class="detail-item">
            <i class="ri-map-pin-line"></i>
            <span>{{ instructor.address }}</span>
          </div>
          <div class="detail-item">
            <i class="ri-user-line"></i>
            <span>{{ instructor.gender }}</span>
          </div>
        </div>

        <!-- Educational Background -->
        <div v-if="instructor.educational_background" class="section">
          <h4>Educational Background</h4>
          <p>{{ instructor.educational_background }}</p>
        </div>

        <!-- Trainings -->
        <div class="section">
          <h4>Trainings</h4>
          <div class="trainings-list">
            <span v-if="instructor.training_pn_instructor_course" class="badge">PN Instructor Course</span>
            <span v-if="instructor.training_course_director_course" class="badge">Course Director</span>
            <span v-if="instructor.training_curriculum_development_course" class="badge">Curriculum Development</span>
            <span v-if="instructor.training_doctrine_writing_course" class="badge">Doctrine Writing</span>
          </div>
          <div v-if="instructor.additional_trainings && instructor.additional_trainings.length > 0" class="additional-trainings">
            <div v-for="(training, idx) in instructor.additional_trainings" :key="idx" class="training-item">
              <strong>{{ training.name }}</strong>
              <span v-if="training.institution"> - {{ training.institution }}</span>
              <span v-if="training.date_completed"> ({{ training.date_completed }})</span>
            </div>
          </div>
        </div>

        <!-- Military Background -->
        <div v-if="instructor.service_entered || instructor.unit_assignment || instructor.designation" class="section">
          <h4>Military Background</h4>
          <div class="military-info">
            <p v-if="instructor.service_entered"><strong>Service Entered:</strong> {{ instructor.service_entered }}</p>
            <p v-if="instructor.unit_assignment"><strong>Unit Assignment:</strong> {{ instructor.unit_assignment }}</p>
            <p v-if="instructor.designation"><strong>Designation:</strong> {{ instructor.designation }}</p>
            <p v-if="instructor.military_schooling"><strong>Schooling:</strong> {{ instructor.military_schooling }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- No Results -->
    <div v-else class="no-results">
      <i class="ri-search-line"></i>
      <p>No instructors found matching your search.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'InstructorList',
  data() {
    return {
      instructors: [],
      searchQuery: ''
    };
  },
  computed: {
    filteredInstructors() {
      if (!this.searchQuery.trim()) {
        return this.instructors;
      }
      
      const query = this.searchQuery.toLowerCase();
      return this.instructors.filter(instructor => {
        return (
          instructor.full_name?.toLowerCase().includes(query) ||
          instructor.name_with_initials?.toLowerCase().includes(query) ||
          instructor.index_number?.toLowerCase().includes(query) ||
          instructor.email?.toLowerCase().includes(query) ||
          instructor.phone_number?.includes(query) ||
          instructor.address?.toLowerCase().includes(query)
        );
      });
    }
  },
  mounted() {
    this.fetchInstructors();
  },
  methods: {
    fetchInstructors() {
      axios.get('/api/instructors')
        .then(response => {
          this.instructors = response.data.map(instructor => {
            // Parse additional_trainings if it's a JSON string
            if (typeof instructor.additional_trainings === 'string') {
              try {
                instructor.additional_trainings = JSON.parse(instructor.additional_trainings);
              } catch (e) {
                instructor.additional_trainings = [];
              }
            }
            return instructor;
          });
        })
        .catch(error => {
          console.error('Error fetching instructors:', error);
          this.instructors = [];
        });
    }
  }
};
</script>

<style scoped>
.instructor-list-container {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 1rem;
}

h2 {
  color: #2c3e50;
  text-align: center;
  margin-bottom: 2rem;
  font-size: 2rem;
}

.search-section {
  margin-bottom: 2rem;
}

.search-input {
  width: 100%;
  padding: 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 1rem;
  transition: border-color 0.3s;
}

.search-input:focus {
  outline: none;
  border-color: #3498db;
  box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.instructors-grid {
  display: grid;
  gap: 1.5rem;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
}

.instructor-card {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
}

.instructor-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.instructor-header {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #f0f0f0;
}

.instructor-photo {
  flex-shrink: 0;
}

.instructor-photo img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #e5e7eb;
}

.instructor-info h3 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.2rem;
}

.instructor-info .initials {
  margin: 0.25rem 0;
  color: #7f8c8d;
  font-size: 0.9rem;
}

.instructor-info .index-number {
  margin: 0.25rem 0;
  color: #95a5a6;
  font-size: 0.85rem;
}

.instructor-details {
  margin-bottom: 1rem;
}

.detail-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  color: #555;
}

.detail-item i {
  color: #3498db;
  font-size: 1.1rem;
}

.section {
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid #f0f0f0;
}

.section h4 {
  margin: 0 0 0.75rem 0;
  color: #34495e;
  font-size: 1rem;
  font-weight: 600;
}

.section p {
  margin: 0.5rem 0;
  color: #555;
  font-size: 0.9rem;
  line-height: 1.5;
}

.trainings-list {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 0.75rem;
}

.badge {
  background: #3498db;
  color: white;
  padding: 0.35rem 0.75rem;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 500;
}

.additional-trainings {
  margin-top: 0.75rem;
}

.training-item {
  padding: 0.5rem 0;
  font-size: 0.9rem;
  color: #555;
}

.training-item strong {
  color: #2c3e50;
}

.military-info p {
  margin: 0.5rem 0;
  color: #555;
  font-size: 0.9rem;
}

.military-info strong {
  color: #34495e;
}

.no-results {
  text-align: center;
  padding: 4rem 2rem;
  color: #95a5a6;
}

.no-results i {
  font-size: 4rem;
  margin-bottom: 1rem;
}

.no-results p {
  font-size: 1.1rem;
  margin: 0;
}

@media (max-width: 768px) {
  .instructors-grid {
    grid-template-columns: 1fr;
  }
  
  .instructor-header {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
}
</style>
