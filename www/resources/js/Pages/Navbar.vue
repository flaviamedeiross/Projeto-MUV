<!-- resources/js/Components/Navbar.vue -->
<script setup>
import { defineProps } from 'vue';
</script>

<template>
  <nav class="bg-gray-800 p-4">
    <div class="container mx-auto">
      <div class="flex items-center justify-between">
        <a href="/" class="text-white font-bold hover:underline">Clínica Veterinária</a>
        <div>
          <a href="#contatos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Contatos</button></a>
          <a href="#contatos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Entre em contato</button></a>
          <a href="/login" class="text-white font-bold hover:underline ml-4">Login</a>
          <a href="/adocao" class="text-white font-bold hover:underline ml-4">Adoção de animais</a>

        </div>
      </div>
    </div>
  </nav>
</template>


<script>
    import { Link } from '@inertiajs/inertia-vue3';
</script>