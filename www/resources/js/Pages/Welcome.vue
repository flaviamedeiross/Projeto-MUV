<template>
  <div class="bg-gray-100 min-h-screen flex flex-col">
    <Navbar />

<<<<<<< HEAD
    <div class="container mx-auto px-4 py-12">
      <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">MUV</h1>

         <!-- Imagem redonda -->
      <div class="flex justify-center mb-8">
        <img src="https://i.pinimg.com/236x/f4/5d/22/f45d22ca31d82fd0bf7101dda9e9e051.jpg" alt="Clínica Veterinária" class="w-40 h-40 rounded-full">
      </div>

      <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <p class="text-lg text-gray-700 leading-relaxed mb-6 text-center">
          Na MUV, nossa missão é proporcionar as melhores experiencias nas suas viagens.
          Contamos com uma equipe experiente prontos para atender a todas as necessidades e interesses dos nossas clientes para garantir uma viagem personalizada e inesquecivel.
        </p>
      </div>

      <h2 class="text-3xl font-bold text-gray-800 mt-8 text-center">Nossos Serviços:</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="font-semibold text-xl text-gray-800">Pacotes de viagens</h3>
          <p class="text-gray-700">Encontre os pacotes para vivenciar as melhores experiencias.</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="font-semibold text-xl text-gray-800">Plano Premium</h3>
          <p class="text-gray-700">Receba mensalmente nossas sujestoes de experiencias e destinos.</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="font-semibold text-xl text-gray-800">Consultoria de Experiencias</h3>
          <p class="text-gray-700">Nos diga o que esta procurando e nos te forneceremos as melhores experiencias</p>
        </div>
        
      </div>
          <div class="mt-8">
            <strong>Entre em contato</strong>
            <form @submit.prevent="sendEmail" class="mt-4">
              <div class="mb-4">
                <label for="email" class="block text-gray-700, text-center">Email:</label>
                <input type="email" v-model="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" />
              </div>
              <div class="mb-4">
                <label for="subject" class="block text-gray-700, text-center">Assunto:</label>
                <input type="text" v-model="subject" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" />
              </div>
              <div class="mb-4">
                <label for="message" class="block text-gray-700, text-center">Mensagem:</label>
                <textarea v-model="message" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
              </div>
              <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-md">Enviar</button>
            </form>        
          </div>
      </div>
    </div>
          <p id="contatos" class="mt-8">
          <Fimdapagina />
          </p>
=======
    <div class="relative w-full h-[350px]">
      <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('/storage/images/beach.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
      </div>
      
      <div class="relative z-40 p-20 text-white flex items-center space-x-10">
        <img :src="'/storage/images/logo.jpeg'" alt="Logo" class="w-40 h-40 rounded-full" />
        <div>
          <h1 class="text-5xl font-bold">MUV</h1>
          <p class="mt-4">
            Na MUV, nossa missão é proporcionar as melhores experiências nas suas viagens.
            Contamos com uma equipe experiente pronta para atender a todas as necessidades e interesses dos nossos clientes para garantir uma viagem personalizada e inesquecível.
          </p>
        </div>
      </div>
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
>>>>>>> Home
          
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

<<<<<<< HEAD
  const email = ref('');
  const subject = ref('');
  const message = ref('');

  const sendEmail = async () => {
    try {
      const response = await axios.post('/send-email', {
        email: email.value,
        subject: subject.value,
        message: message.value,
      });
      alert(response.data.message);
    } catch (error) {
      console.error('Erro ao enviar email:', error);
      alert('Erro ao enviar email');
    }
  };



=======
>>>>>>> Home
</script>