<!-- components/Navbar.vue -->
<template>
  <nav class="bg-gray-800 text-white px-4 py-3 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
      <NuxtLink to="/" class="text-lg font-semibold hover:text-gray-300">
        🏠 My App
      </NuxtLink>

      <div class="space-x-4">
        <NuxtLink to="/categories" class="hover:text-gray-300">Kategorie materialů</NuxtLink>
        <NuxtLink to="/materials" class="hover:text-gray-300">Materialy</NuxtLink>
        <NuxtLink to="/about" class="hover:text-gray-300">About</NuxtLink>
        <NuxtLink to="/users" class="hover:text-gray-300">Správa uživatelů</NuxtLink>
      </div>
    </div>
  </nav>
</template>
