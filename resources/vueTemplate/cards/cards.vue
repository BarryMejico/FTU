<template>
    <div>
        <div class="controls">
            <input
                v-model="search"
                type="text"
                placeholder="Search cards..."
                class="search-bar"
            />
            <button @click="addCard" class="add-btn">Add</button>
        </div>
        <div class="cards-container">
            <Card
                v-for="(item, index) in filteredCards"
                :key="index"
                :data="item"
            />
        </div>
    </div>
</template>

<script>
import Card from './card.vue'

export default {
    components: {
        Card
    },
    data() {
        return {
            search: '',
            cards: [
                { title: 'Card 1', description: 'Description 1' },
                { title: 'Card 2', description: 'Description 2' },
                { title: 'Card 3', description: 'Description 3' }
            ]
        }
    },
    computed: {
        filteredCards() {
            if (!this.search) return this.cards
            const s = this.search.toLowerCase()
            return this.cards.filter(card =>
                card.title.toLowerCase().includes(s) ||
                card.description.toLowerCase().includes(s)
            )
        }
    },
    methods: {
        addCard() {
            this.cards.push({
                title: `Card ${this.cards.length + 1}`,
                description: `Description ${this.cards.length + 1}`
            })
        }
    }
}
</script>

<style scoped>
.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}
.controls {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    gap: 8px;
}
.search-bar {
    flex: 1;
    padding: 8px;
    font-size: 16px;
}
.add-btn {
    padding: 8px 16px;
    font-size: 16px;
    cursor: pointer;
}
</style>