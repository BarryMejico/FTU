<template>
    <div class="relative">
        <Loading v-if="isLoading" />

        <div v-show="!isLoading">
            <h1>
                Admin Dashboard
            </h1>
            <hr>
            <RouterView></RouterView>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Loading from './Loading.vue'

const isLoading = ref(true)

// Replace this simulated delay with your real async data loading (API calls, store init, etc.)
onMounted(async () => {
    try {
        // Example: await fetchInitialData()
        await new Promise(resolve => setTimeout(resolve, 700))
    } finally {
        isLoading.value = false
    }
})
</script>
