<script setup>
import { onMounted, ref } from 'vue'
const categories = ref([])

onMounted(async () => {
  const res = await fetch('http://localhost:8080/api/categories')
  categories.value = await res.json()
})
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Categories</h1>

    <NuxtLink to="/categories/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
      ➕ Add Category
    </NuxtLink>

    <div class="mt-6 grid gap-4 md:grid-cols-2">
      <div v-for="category in categories" :key="category.id" class="border p-4 rounded shadow">
        <h2 class="text-xl font-semibold">{{ category.name }}</h2>
        <p class="text-gray-500">Material ID: {{ category.materialId }}</p>

        <div class="mt-3 flex gap-2">
          <NuxtLink :to="`/categories/edit/${category.id}`" class="text-blue-500 underline">Edit</NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>
