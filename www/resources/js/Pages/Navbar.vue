<!-- resources/js/Components/Navbar.vue -->
<script setup>
import { defineProps } from 'vue';
</script>

<template>
  <nav class="bg-800 p-2 shadow-[0_4px_6px_0_rgba(0,0,0,0.1)]" style="background-color: #0b1141;">
    <div class="container mx-auto">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4"> 
          <img src="/storage/images/logoa.jpg" alt="Logo de MUV" class="ml-3 max-w-[50px] max-h-[50px] object-contain">
          <a href="/" class="text-white font-bold hover:underline text-2xl">MUV</a>
          <div class="flex items-center space-x-4 ml-auto text-right">
            <a href="#contatos">
              <button @click="scrollToContato" class="text-white hover:underline">Contatos</button>
            </a>
            <a href="#contatos">
              <button @click="scrollToContato" class="text-white hover:underline">Entre em contato</button>
            </a>
            <a href="/login" class="text-white hover:underline">Login</a>
            <a href="/adocao" class="text-white hover:underline">Adoção de animais</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>


<script>
    import { Link } from '@inertiajs/inertia-vue3';
</script>