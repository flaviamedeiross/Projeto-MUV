<template>
  <div class="bg-100 min-h-screen flex flex-col" >
    <Navbar />

    <div class="relative w-full h-[350px]">
      <img src="/storage/images/MUV (3).png" alt="Imagem de MUV" class="w-full h-full object-cover" />
    </div>

    <div class="container mx-auto px-4 py-6">
      <div class="max-w-4xl mx-auto">

      <h2 class="text-3xl font-bold text-gray-800 mt-8 text-center">Nossos Serviços:</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        
        <div>
          <img :src="'/storage/images/aviao.jpg'" alt="img1" class="w-full h-40 object-cover rounded-t-md"/>
          <div class="bg-white shadow-lg rounded-b-lg p-6">
            <h3 class="font-semibold text-xl text-gray-800">Pacotes de viagens</h3>
            <p class="text-gray-700">Encontre os pacotes para vivenciar as melhores experiencias.</p>
          </div>
        </div>

        <div>
          <img :src="'/storage/images/premium.jpg'" alt="img1" class="w-full h-40 object-cover rounded-t-md"/>
          <div class="bg-white shadow-lg rounded-b-lg p-6">
            <h3 class="font-semibold text-xl text-gray-800">Plano Premium</h3>
            <p class="text-gray-700">Receba mensalmente nossas sujestoes de experiencias e destinos.</p>
          </div>
        </div>

        <div>
          <img :src="'/storage/images/consulta.jpg'" alt="img1" class="w-full h-40 object-cover rounded-t-md"/>
          <div class="bg-white shadow-lg rounded-b-lg p-6">
            <h3 class="font-semibold text-xl text-gray-800">Consultoria de Experiências</h3>
            <p class="text-gray-700">Nos diga o que esta procurando e nos te forneceremos as melhores experiencias</p>
          </div>
        </div>
        
      </div>
    </div>
  </div>

    <p id="contatos" class="mt-8">
      <Fimdapagina />
    </p>
          
  </div>
</template>

<script setup>
  import Navbar from './Navbar.vue';
  import Fimdapagina from './Fimdapagina.vue';
  import { Head, Link } from '@inertiajs/inertia-vue3';
  import { ref } from 'vue';

  defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  });

</script>