<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import { defineProps } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  reservas: Array
})

function destroy(id) {
  if (confirm('Tem certeza que deseja excluir esta reserva?')) {
    Inertia.delete(`/reservas/${id}`)
  }
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Reservas
      </h2>
    </template>

    <div class="p-6">

      <table class="w-full table-auto border bg-gray-300">
        <thead>
          <tr class="bg-gray-400">
            <th class="p-2 border">Cliente</th>
            <th class="p-2 border">Tipo</th>
            <th class="p-2 border">Viagem</th>
            <th class="p-2 border">Data</th>
            <th class="p-2 border">Sugestões</th>
            <th class="p-2 border">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="reserv in reservas" :key="reserv.id">
            <td class="p-2 border">{{ reserv.cliente.nome }}</td>
            <td class="p-2 border">{{ reserv.tipo_exp }}</td> 
            <td class="p-2 border">{{ reserv.trip.cidade }}</td> 
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
  </AuthenticatedLayout>
</template>
