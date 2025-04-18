<!-- resources/js/Components/Navbar.vue -->
<script setup>
import { defineProps } from 'vue';
</script>

<template>
  <nav class="bg-indigo-950 p-2 fixed top-0 right-0 left-0 z-50">
    <div class="container mx-auto">
      <div class="flex items-center justify-between">
        <img :src="'/storage/images/logo_dark.jpeg'" alt="Logo" class="h-10 w-10 object-fill" />
        <a href="/" class="text-white font-bold hover:underline absolute inset-x-16 top-4">MUV</a>
        <div>
          <a href="/login" class="text-white font-bold hover:underline ml-4 absolute top-4 right-6">Login</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="relative size-20">
    <div class="absolute inset-x-0 top-0 h-16"></div>
  </div>
</template>


<script>
    import { Link } from '@inertiajs/inertia-vue3';
</script>