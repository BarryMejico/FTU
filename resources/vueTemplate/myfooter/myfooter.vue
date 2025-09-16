<template>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
            </div>
            
            <div class="footer-column">
                <h3>Mission</h3>
                <p>To provide high standard and responsive Budget, 
                Fiscal and Finance Education and Training to develop a competent, excellent 
                and highly-skilled BFF professionals for the Philippine Navy.</p>
            </div>
            
            <div class="footer-column">
                <h3>Vision</h3>
                <p>By 2028, to be a competent and capable Budget, Fiscal and Finance (BFF)
                Education and Training Administrator that produces motivated, excellent and
                highly-skilled BFF Professionals for the Philippine Navy.</p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'MyFooter'
}
</script>

<style scoped>
.footer {
    background-color: #2c3e50;
    color: #ffffff;
    padding: 3rem 0;
    margin-top: auto;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    gap: 2rem;
}

.footer-column {
    flex: 1;
    min-width: 0;
}

.footer-column h3 {
    color: #ecf0f1;
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-column h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background-color: #3498db;
}

.footer-column p {
    color: #bdc3c7;
    line-height: 1.6;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
    }

    .footer-column h3::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .footer-column {
        margin-bottom: 2rem;
    }

    .footer-column:last-child {
        margin-bottom: 0;
    }
}
</style>