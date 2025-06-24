<script setup>
import { ref } from 'vue'
import { useAsyncData } from '#app'

const showForm = ref(false)
const materialId = ref('')
const name = ref('')
const message = ref('')

// Použij useAsyncData místo useFetch (lepší kontrola nad refresh)
const {
  data: categories,
  pending,
  error,
  refresh,
} = await useAsyncData('categories', () =>
  $fetch('http://localhost:8080/api/categories'),
  { server: false } // klientské načtení
)

// Odeslání nové kategorie
const submit = async () => {
  try {
    await $fetch('http://localhost:8080/api/categories', {
      method: 'POST',
      body: {
        materialId: materialId.value,
        name: name.value,
      },
    })
    message.value = '✅ Kategorie vytvořena!'
    materialId.value = ''
    name.value = ''
    showForm.value = false
    await refresh() // znovunačti data
  } catch (err) {
    message.value = '❌ Chyba: ' + err.message
  }
}

// Odstrananění nové kategorie.

const deleteCategory = async (id) => {
  if (!confirm('Opravdu chceš tuto kategorii smazat?')) return
  try {
    await $fetch(`http://localhost:8080/api/categories/${id}`, {
      method: 'DELETE',
    })
    message.value = '🗑️ Kategorie smazána!'
    await refresh() // nebo await loadCategories()
  } catch (err) {
    message.value = '❌ Chyba při mazání: ' + err.message
  }
}




</script>


<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">📦 Categories</h1>

    <!-- Tlačítko pro zobrazení formuláře -->
    <div class="mb-4">
      <button
        @click="showForm = !showForm"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded"
      >
        ➕ Add Category
      </button>
    </div>

    <!-- Formulář -->
    <div v-if="showForm" class="mb-6 bg-gray-50 border p-4 rounded shadow">
      <h2 class="text-lg font-semibold mb-2">Nová kategorie</h2>
      <form @submit.prevent="submit" class="space-y-2">
        <input v-model="materialId" class="border p-2 w-full" placeholder="Material ID" />
        <input v-model="name" class="border p-2 w-full" placeholder="Name" />
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
          💾 Uložit
        </button>
        <p class="text-sm mt-2">{{ message }}</p>
      </form>
    </div>

    <!-- Tabulka -->
    <div v-if="pending">Loading...</div>
    <div v-else-if="error">
      ❌ Failed to load categories:
      <pre class="bg-red-100 text-red-800 p-2 mt-2">{{ error }}</pre>
    </div>
    <div v-else>
      <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Material ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Akce</th> <!-- Nový sloupec -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories.member" :key="category.id">
            <td class="border px-4 py-2">{{ category.id }}</td>
            <td class="border px-4 py-2">{{ category.materialId }}</td>
            <td class="border px-4 py-2">{{ category.name }}</td>
            <td class="border px-4 py-2 text-center">
              <button
                @click="deleteCategory(category.id)"
                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm"
              >
                🗑️ Smazat
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
