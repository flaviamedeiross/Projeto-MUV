<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastro de Viagens</h2>
    </template>

    <div class="py-6 max-w-4xl mx-auto">
      <form @submit.prevent="submitForm" class="bg-white p-6 rounded shadow-md">
        <div class="mb-4">
          <label class="block font-bold">Cidade Destino:</label>
          <input v-model="form.cidade" class="w-full border p-2 rounded" type="text" />
        </div>
        <div class="mb-4">
          <label class="block font-bold">País:</label>
          <input v-model="form.pais" class="w-full border p-2 rounded" type="text" />
        </div>
        <div class="mb-4">
          <label class="block font-bold">Descrição:</label>
          <input v-model="form.informacao" class="w-full border p-2 rounded" type="text" />
        </div>
        <div class="mb-4">
          <label class="block font-bold">Data de partida:</label>
          <input v-model="form.data_partida" class="w-full border p-2 rounded" type="date" />
        </div>
        <div class="mb-4">
          <label class="block font-bold">Data de volta:</label>
          <input v-model="form.data_chegada" class="w-full border p-2 rounded" type="date" />
        </div>
        <div class="mb-4">
          <label class="block font-bold">Preço:</label>
          <input v-model="form.preco" class="w-full border p-2 rounded" type="number" />
        </div>
        <div class="mb-4">
          <label class="block font-bold">Quantidade Disponível:</label>
          <input v-model="form.quantidade_disponivel" class="w-full border p-2 rounded" type="number" />
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
        <p v-if="message" class="text-green-600 mt-2">{{ message }}</p>
        <p v-if="errorMessage" class="text-red-600 mt-2">{{ errorMessage }}</p>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    AuthenticatedLayout
  },
  data() {
    return {
      form: {
        cidade: '',
        pais: '',
        informacao: '',
        data_partida: '',
        data_chegada: '',
        preco: '',
        quantidade_disponivel: ''
      },
      message: '',
      errorMessage: ''
    };
  },
  methods: {
    async submitForm() {
      this.message = '';
      this.errorMessage = '';

      try {
        await Inertia.post(route('viagens.store'), this.form, {
          onSuccess: () => {
            this.message = 'Viagem registrada com sucesso!';
            this.resetForm();
          },
          onError: (errors) => {
            this.errorMessage = 'Erro ao registrar viagem.';
            console.error(errors);
          }
        });
      } catch (error) {
        console.error('Erro inesperado:', error);
        this.errorMessage = 'Erro inesperado ao registrar.';
      }
    },
    resetForm() {
      this.form = {
        cidade: '',
        pais: '',
        informacao: '',
        data_partida: '',
        data_chegada: '',
        preco: '',
        quantidade_disponivel: ''
      };
    }
  }
};
</script>
