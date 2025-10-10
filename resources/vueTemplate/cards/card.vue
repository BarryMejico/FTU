<template>
    <div class="card">
        <h2 class="card-title">Card Title</h2>
        <p class="card-details">
            Card details go here. You can add more information about the card.
        </p>
    </div>
</template>

<script>
export default {
    name: 'Card',
    props: {
        title: {
            type: String,
            default: 'Card Title'
        },
        details: {
            type: String,
            default: 'Card details go here. You can add more information about the card.'
        }
    }
}
</script>

<style scoped>
.card {
    width: 262px;
    height: 262px;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: #fff;
    padding: 24px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 16px;
    text-align: center;
}

.card-details {
    font-size: 1rem;
    color: #555;
    text-align: center;
}
</style>