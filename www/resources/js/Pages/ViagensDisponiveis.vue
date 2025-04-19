<template>
    <div>
        <h1>Viagens Disponíveis</h1>
        <div v-for="viagem in viagens" :key="viagem.id">
            <h3>{{ viagem.cidade }} - {{ viagem.pais }}</h3>
            <p>{{ viagem.informacao }}</p>
            <button @click="comprarViagem(viagem.id)">Comprar</button>
            <button @click="verSugestoes(viagem.id)">Ver Sugestões</button>
        </div>
    </div>
</template>

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
