<script setup>

    const props = defineProps({
    variant: {
        type: String,
        default: 'primary',
    },
    type: {
        type: String,
        default: 'button',
    },
    disabled: Boolean,
    loading: Boolean,
    })

    const baseClass =
    'transition duration-200 inline-flex items-center font-semibold px-4 py-2 rounded text-white text-sm'

    const variantClasses = {
    primary: 'bg-blue-600 hover:bg-blue-700',
    danger: 'bg-red-600 hover:bg-red-700',
    warning: 'bg-yellow-500 hover:bg-yellow-600',
    gray: 'bg-gray-400 hover:bg-gray-500',
    success: 'bg-green-600 hover:bg-green-700',
    }
    
</script>

<template>
  <button
    :type="type"
    :disabled="disabled || loading"
    :class="[
      baseClass,
      variantClasses[variant] || variantClasses.primary,
      loading && 'opacity-50 cursor-not-allowed',
    ]"
  >
    <span v-if="loading">⏳</span>
    <slot />
  </button>
</template>

