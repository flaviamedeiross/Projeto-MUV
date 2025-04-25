<template>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Minhas Viagens</h1>
  
      <div v-if="reservas.length">
        <div v-for="reserv in reservas" :key="reserv.id" class="border p-4 rounded mb-4 shadow">
          <p><strong>Data da Reserva:</strong> {{ formatDate(reserv.date_reserv) }}</p>
          <p><strong>Tipo:</strong> {{ reserv.tipo_exp }}</p>
          <div v-if="reserv.trip">
            <p><strong>Viagem:</strong> {{ reserv.trip.nome }}</p>
            <p><strong>Destino:</strong> {{ reserv.trip.destino }}</p>
            <p><strong>Preço:</strong> R$ {{ reserv.trip.preco }}</p>
          </div>
        </div>
      </div>
  
      <div v-else>
        <p>Você ainda não tem nenhuma viagem reservada.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    reservas: Array
  })
  
  function formatDate(date) {
    if (!date) return ''
    return new Date(date).toLocaleDateString('pt-BR')
  }
  </script>
  