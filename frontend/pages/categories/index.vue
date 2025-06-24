<script setup>
const { data: categories, pending, error } = await useFetch('http://nginx/api/categories')
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">📦 Categories</h1>

    <div v-if="pending">Loading...</div>
    <div v-else-if="error">❌ Failed to load categories.</div>
    <div v-else>
      <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Material ID</th>
            <th class="border px-4 py-2">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories.member" :key="category.id">
            <td class="border px-4 py-2">{{ category.id }}</td>
            <td class="border px-4 py-2">{{ category.materialId }}</td>
            <td class="border px-4 py-2">{{ category.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

