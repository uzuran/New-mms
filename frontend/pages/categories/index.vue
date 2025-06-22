<script setup>
import { ref, onMounted } from 'vue'

const status = ref(null)
const error = ref(null)

const checkHealth = async () => {
  status.value = null
  error.value = null

  try {
    const res = await fetch('http://localhost:8080/api/categories')
    if (!res.ok) throw new Error('Network response was not OK')

    const data = await res.json()
    status.value = data
  } catch (err) {
    error.value = err
  }
}

onMounted(() => {
  checkHealth()
})
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">API Health Check</h1>

    <div v-if="error" class="text-red-600">
      API is down 😞 <br />
      <small>{{ error.message }}</small>
    </div>

    <div v-else-if="status">
      API is up ✅ <br />
      <small>Checked at: {{ status.timestamp }}</small>
    </div>

    <div v-else>
      Checking API status...
    </div>

    <button
      @click="checkHealth"
      class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
      Refresh
    </button>
  </div>
</template>

