<template>
    <div class="error-page">
        <div class="error-content">
            <h1 class="error-title">404</h1>
            <h2 class="error-subtitle">Page Not Found</h2>
            <p class="error-message">
                Sorry, the page you are looking for does not exist or has been moved.
            </p>
            <router-link to="/" class="home-link">
                Go to Homepage
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "NotFoundPage",
};
</script>

<style scoped>
.error-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.error-content {
    text-align: center;
    padding: 1.2rem 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(60, 72, 88, 0.10);
}

.error-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: #2563eb;
    margin-bottom: 0.3rem;
}

.error-subtitle {
    font-size: 1.2rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.7rem;
}

.error-message {
    font-size: 0.95rem;
    color: #64748b;
    margin-bottom: 1.2rem;
}

.home-link {
    display: inline-block;
    padding: 0.5rem 1.2rem;
    background: #2563eb;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.2s;
    font-size: 0.95rem;
}

.home-link:hover {
    background: #1e40af;
}
</style>