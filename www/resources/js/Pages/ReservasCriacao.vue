<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { reactive } from 'vue'
import { defineProps } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  clientes: Array,
  trips: Array,
  sugests: Array
})

const form = reactive({
  cliente_id: null,
  tipo_exp: null,
  trip_id: null,
  date_reserv: null,
  sugestao_ids: []
})

function submit() {
  console.log("Enviando form:", form)
  Inertia.post('/reservas', form)
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Nova Reserva
      </h2>
    </template>

    <div class="p-6 max-w-xl mx-auto">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1 font-bold">Cliente</label>
          <select v-model="form.cliente_id" class="w-full border rounded p-2">
            <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
              {{ cliente.nome }}
            </option>
          </select>
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-bold">Tipo de Experiencia</label>
          <select v-model="form.tipo_exp" class="w-full border rounded p-2">
            <option value="" disabled selected>Selecione uma espécie</option>
            <option value="gastronomia">Gatronomia</option>
            <option value="musica">Musica</option>
            <option value="Danca">Danca</option>
            <option value="historia">Historia</option>
            <option value="Arte">Arte</option>
            <option value="outros">Outros</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-bold">Viagem</label>
          <select v-model="form.trip_id" class="w-full border rounded p-2">
            <option v-for="trip in trips" :key="trip.id" :value="trip.id">
              {{ trip.titulo }} ({{ trip.quantidade_disponivel }} disponíveis)
            </option>
          </select>
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-bold">Data da Reserva</label>
          <input type="date" v-model="form.date_reserv" class="w-full border rounded p-2" />
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-bold">Sugestões</label>
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
  </AuthenticatedLayout>
</template>

