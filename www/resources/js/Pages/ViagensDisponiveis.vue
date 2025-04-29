<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue'
</script>

<script>
export default {
    props: {
        viagens: Array
    },
    methods: {
        comprarViagem(id) {
            axios.post(`/api/trips/comprar/${id}`)
                .then(response => {
                    alert('Compra realizada!');
                })
                .catch(error => {
                    alert('Erro: ' + error.response.data.mensagem);
                });
        },
        verSugestoes(tripId) {
            this.$inertia.get(`/sugestao/${tripId}`);
        }
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Viagens Disponíveis
            </h2>
        </template>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">

            <div v-for="viagem in viagens" :key="viagem.id">
                <div class="bg-white shadow-lg rounded-b-lg p-6">
                    <img :src="'/storage/images/aviao.jpg'" alt="img1" class="w-full h-40 object-cover rounded-md" />
                    <h3 class="font-semibold text-xl text-gray-800 mt-2">{{ viagem.cidade }} - {{ viagem.pais }}</h3>
                    <p class="text-gray-700">{{ viagem.informacao }}</p>
                    <div class="flex justify-between mt-4">
                        <button @click="comprarViagem(viagem.id)" class="bg-cyan-700 text-white px-4 py-2 rounded">Comprar</button>
                        <button @click="verSugestoes(viagem.id)" class="bg-indigo-700 text-white px-4 py-2 rounded">Ver Sugestões</button>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
