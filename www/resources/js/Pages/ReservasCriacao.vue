<template>
    <div class="p-6 max-w-xl mx-auto">
      <h1 class="text-xl font-bold mb-4">Nova Reserva</h1>
  
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1">Cliente</label>
          <select v-model="form.cliente_id" class="w-full border rounded p-2">
            <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
              {{ cliente.nome }}
            </option>
          </select>
        </div>
  
        <div class="mb-4">
          <label class="block mb-1">Viagem</label>
          <select v-model="form.trip_id" class="w-full border rounded p-2">
            <option v-for="trip in trips" :key="trip.id" :value="trip.id">
              {{ trip.titulo }} ({{ trip.quantidade_disponivel }} disponíveis)
            </option>
          </select>
        </div>
  
        <div class="mb-4">
          <label class="block mb-1">Data da Reserva</label>
          <input type="date" v-model="form.date_reserv" class="w-full border rounded p-2" />
        </div>
  
        <div class="mb-4">
          <label class="block mb-1">Sugestões</label>
          <div v-for="sugest in sugests" :key="sugest.id">
            <label>
              <input type="checkbox" :value="sugest.id" v-model="form.sugestao_ids" />
              {{ sugest.nome }} ({{ sugest.interesse }})
            </label>
          </div>
        </div>
  
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { reactive } from 'vue'
  import { router } from '@inertiajs/vue3'
  import { defineProps } from 'vue'
  
  const props = defineProps({
    clientes: Array,
    trips: Array,
    sugests: Array
  })
  
  const form = reactive({
    cliente_id: null,
    trip_id: null,
    date_reserv: null,
    sugestao_ids: []
  })
  
  function submit() {
    router.post('/reservas', form)
  }
  </script>
  