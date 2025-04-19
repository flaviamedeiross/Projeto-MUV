<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastro de Sugestões</h2>
      </template>
  
      <div class="py-6 max-w-4xl mx-auto">
        <form @submit.prevent="submitForm" class="bg-white p-6 rounded shadow-md">
          <div class="mb-4">
            <label class="block font-bold">Nome do lugar:</label>
            <input v-model="form.nome" class="w-full border p-2 rounded" type="text" />
          </div>
  
          <div class="mb-4">
            <label class="block font-bold">Descrição:</label>
            <textarea v-model="form.descricao" class="w-full border p-2 rounded" rows="4" />
          </div>
  
          <div class="mb-4">
            <label class="block font-bold">Interesse:</label>
            <select v-model="form.interesse" class="w-full border p-2 rounded">
                <option disabled value="">Selecione um interesse</option>
                <option value="gastronomia">Gastronomia</option>
                <option value="natureza">Natureza</option>
                <option value="religiao">Religião</option>
                <option value="compras">Compras</option>
                <option value="cultura">Cultura</option>
            </select>
            </div>
  
          <div class="mb-4">
            <label class="block font-bold">Viagem relacionada:</label>
            <select v-model="form.trip_id" class="w-full border p-2 rounded">
              <option disabled value="">Selecione uma viagem</option>
              <option v-for="viagem in viagens" :key="viagem.id" :value="viagem.id">
                {{ viagem.cidade }} - {{ viagem.pais }}
              </option>
            </select>
          </div>
  
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
          <p v-if="message" class="text-green-600 mt-2">{{ message }}</p>
          <p v-if="errorMessage" class="text-red-600 mt-2">{{ errorMessage }}</p>
        </form>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import { Inertia } from '@inertiajs/inertia'
  
  export default {
    props: {
      viagens: Array
    },
    components: {
      AuthenticatedLayout
    },
    data() {
      return {
        form: {
          nome: '',
          descricao: '',
          interesse: '',
          trip_id: ''
        },
        message: '',
        errorMessage: ''
      }
    },
    methods: {
      async submitForm() {
        this.message = ''
        this.errorMessage = ''
  
        try {
          await Inertia.post(route('sugests.store'), this.form, {
            onSuccess: () => {
              this.message = 'Sugestão registrada com sucesso!'
              this.resetForm()
            },
            onError: (errors) => {
              this.errorMessage = 'Erro ao registrar sugestão.'
              console.error(errors)
            }
          })
        } catch (error) {
          console.error('Erro inesperado:', error)
          this.errorMessage = 'Erro inesperado ao registrar.'
        }
      },
      resetForm() {
        this.form = {
          nome: '',
          descricao: '',
          interesse: '',
          trip_id: ''
        }
      }
    }
  }
  </script>
  