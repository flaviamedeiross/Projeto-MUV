<template>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Reservas</h1>
  
      <table class="w-full table-auto border">
        <thead>
          <tr class="bg-gray-100">
            <th class="p-2 border">Cliente</th>
            <th class="p-2 border">Viagem</th>
            <th class="p-2 border">Data</th>
            <th class="p-2 border">Sugestões</th>
            <th class="p-2 border">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="reserv in reservas" :key="reserv.id">
            <td class="p-2 border">{{ reserv.cliente.nome }}</td>
            <td class="p-2 border">{{ reserv.trip.cidae }}</td>
            <td class="p-2 border">{{ reserv.date_reserv }}</td>
            <td class="p-2 border">
              <ul>
                <li v-for="sug in reserv.sugests" :key="sug.id">{{ sug.nome }}</li>
              </ul>
            </td>
            <td class="p-2 border">
              <Link :href="`/reservas/${reserv.id}/edit`" class="text-blue-500 mr-2">Editar</Link>
              <button @click="destroy(reserv.id)" class="text-red-500">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { router, Link } from '@inertiajs/vue3'
  import { defineProps } from 'vue'
  
  const props = defineProps({
    reservas: Array
  })
  
  function destroy(id) {
    if (confirm('Tem certeza que deseja excluir esta reserva?')) {
      router.delete(`/reservas/${id}`)
    }
  }
  </script>
  