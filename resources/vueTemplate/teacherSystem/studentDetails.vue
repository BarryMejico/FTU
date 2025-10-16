<template>
  <div class="student-tabs">
    <div class="tab-list">
      <button class="tab active">Dashboard</button>
      <button class="tab">Details</button>
      <button class="tab">Education</button>
    </div>
    <div class="tab-content">
      <h2 class="form-title">Student Details</h2>
      <form class="student-form">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" />
        </div>
        <div class="form-group">
          <label for="subject">Subject:</label>
          <input type="text" id="subject" />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" />
        </div>
        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.student-tabs {
  max-width: 500px;
  margin: 2rem auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  padding: 2rem 1.5rem;
}
.tab-list {
  display: flex;
  border-bottom: 2px solid #e5e7eb;
  margin-bottom: 2rem;
}
.tab {
  background: none;
  border: none;
  outline: none;
  padding: 1rem 2rem;
  font-size: 1rem;
  color: #34495e;
  cursor: pointer;
  font-weight: 600;
  border-bottom: 2px solid transparent;
  transition: border-color 0.2s, color 0.2s;
}
.tab.active {
  color: #3498db;
  border-bottom: 2px solid #3498db;
}
.tab:not(.active):hover {
  color: #2980b9;
}
.tab-content {
  margin-top: 1rem;
}
.form-title {
  font-size: 1.5rem;
  color: #2c3e50;
  margin-bottom: 1.5rem;
  font-weight: 700;
}
.student-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
label {
  font-weight: 500;
  color: #34495e;
}
input[type="text"],
input[type="email"] {
  padding: 0.75rem;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
  font-size: 1rem;
  transition: border-color 0.2s;
}
input:focus {
  border-color: #3498db;
  outline: none;
}
.submit-btn {
  padding: 0.75rem 2rem;
  background: #3498db;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  margin-top: 1rem;
  transition: background 0.2s;
}
.submit-btn:hover {
  background: #2980b9;
}
</style>
