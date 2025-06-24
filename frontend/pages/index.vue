<script setup>
import { ref, onMounted } from 'vue'

const isSaving = ref(false)
const isDeleting = ref(false)


const categories = ref([])
const pending = ref(false)
const error = ref(null)

const showForm = ref(false)
const materialId = ref('')
const name = ref('')
const message = ref('')
const editingCategoryId = ref(null)

// Load categories from the API
const loadCategories = async () => {
  try {
    pending.value = true
    const result = await $fetch('http://localhost:8080/api/categories')
    categories.value = result.member ?? result
    error.value = null
  } catch (err) {
    error.value = err.message || 'Neznámá chyba'
  } finally {
    pending.value = false
  }
}

// Open the form for adding a new category
const openNewForm = () => {
  materialId.value = ''
  name.value = ''
  editingCategoryId.value = null
  message.value = ''
  showForm.value = true
}

// Submit the form to create or update a category
const submit = async () => {
  
  isSaving.value = true

  try {
    const url = editingCategoryId.value
      ? `http://localhost:8080/api/categories/${editingCategoryId.value}`
      : 'http://localhost:8080/api/categories'

    const method = editingCategoryId.value ? 'PUT' : 'POST'

    await $fetch(url, {
      method,
      body: {
        materialId: materialId.value,
        name: name.value,
      },
    })

    message.value = editingCategoryId.value
      ? '✏️ Kategorie upravena!'
      : '✅ Kategorie vytvořena!'

    materialId.value = ''
    name.value = ''
    editingCategoryId.value = null
    showForm.value = false
    await loadCategories()
  } catch (err) {
    message.value = '❌ Chyba: ' + (err.message || 'Neznámá chyba')
  } finally {
    isSaving.value = false
  }
}

const editCategory = (category) => {
  materialId.value = category.materialId
  name.value = category.name
  editingCategoryId.value = category.id
  message.value = ''
  showForm.value = true
}

const deleteCategory = async (id) => {
  if (!confirm('Opravdu chceš tuto kategorii smazat?')) return
  isDeleting.value = true
  try {
    await $fetch(`http://localhost:8080/api/categories/${id}`, {
      method: 'DELETE',
    })
    message.value = '🗑️ Kategorie smazána!'
    await loadCategories()
  } catch (err) {
    message.value = '❌ Chyba při mazání: ' + (err.message || 'Neznámá chyba')
  } finally {
    isDeleting.value = false
  }
}


onMounted(() => {
  loadCategories()
})
</script>

<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">📦 Kategorie materiálů</h1>

    <div class="mb-4">
      <BaseButton variant="primary" @click="openNewForm">
        ➕ Přidat novou kategorii
      </BaseButton>
    </div>

    <div v-if="showForm" class="mb-6 bg-gray-50 border p-4 rounded shadow">
      <h2 class="text-lg font-semibold mb-2">
        {{ editingCategoryId ? '✏️ Úprava kategorie' : '➕ Nová kategorie' }}
      </h2>
      <form @submit.prevent="submit" class="space-y-2">
        <input
          v-model="materialId"
          class="border p-2 w-full"
          placeholder="Material ID"
          required
        />
        <input
          v-model="name"
          class="border p-2 w-full"
          placeholder="Name"
          required
        />
        <div class="flex items-center space-x-2">

          <BaseButton
            type="submit"
            variant="success"
            :loading="isSaving"
          >
            💾 {{ editingCategoryId ? 'Uložit změny' : 'Uložit' }}
          </BaseButton>

          <BaseButton variant="gray" @click="showForm = false; editingCategoryId = null; message = ''">
            ✖️ Zrušit
          </BaseButton>

        </div>
        <p class="text-sm mt-2">{{ message }}</p>
      </form>
    </div>

    <div v-if="pending" class="text-center font-semibold">Loading...</div>
    <div v-else-if="error" class="text-red-600">
      ❌ Failed to load categories: <pre class="bg-red-100 p-2 rounded mt-2">{{ error }}</pre>
    </div>
    <div v-else>
      <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Material ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Akce</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td class="border px-4 py-2">{{ category.id }}</td>
            <td class="border px-4 py-2">{{ category.materialId }}</td>
            <td class="border px-4 py-2">{{ category.name }}</td>
            <td class="border px-4 py-2 space-x-2">
              
              <BaseButton variant="warning" @click="editCategory(category)">
                ✏️ Upravit
              </BaseButton>

              <BaseButton variant="danger" @click="deleteCategory(category.id)" :loading="isDeleting">
                🗑️ Smazat
              </BaseButton>

            </td>
          </tr>
          <tr v-if="categories.length === 0">
            <td colspan="4" class="text-center py-4">Žádné kategorie</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
