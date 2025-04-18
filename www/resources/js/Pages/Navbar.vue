<!-- resources/js/Components/Navbar.vue -->
<script setup>
import { defineProps } from 'vue';
</script>

<template>
<<<<<<< HEAD
  <nav class="bg-gray-800 p-4">
    <div class="container mx-auto">
      <div class="flex items-center justify-between">
        <a href="/" class="text-white font-bold hover:underline">Clínica Veterinária</a>
        <div>
          <a href="#contatos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Contatos</button></a>
          <a href="#contatos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Entre em contato</button></a>
          <a href="/login" class="text-white font-bold hover:underline ml-4">Login</a>
          <a href="/adocao" class="text-white font-bold hover:underline ml-4">Adoção de animais</a>

=======
  <nav class="bg-indigo-950 p-2 fixed top-0 right-0 left-0 z-50">
    <div class="container mx-auto">
      <div class="flex items-center justify-between">
        <img :src="'/storage/images/logo_dark.jpeg'" alt="Logo" class="h-10 w-10 object-fill" />
        <a href="/" class="text-white font-bold hover:underline absolute inset-x-16 top-4">MUV</a>
        <div>
          <a href="/login" class="text-white font-bold hover:underline ml-4 absolute top-4 right-6">Login</a>
>>>>>>> Home
        </div>
      </div>
    </div>
  </nav>
<<<<<<< HEAD
=======
  <div class="relative size-20">
    <div class="absolute inset-x-0 top-0 h-16"></div>
  </div>
>>>>>>> Home
</template>


<script>
    import { Link } from '@inertiajs/inertia-vue3';
</script>