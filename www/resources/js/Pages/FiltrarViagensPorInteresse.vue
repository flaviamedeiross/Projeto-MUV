<template>
    <div>
        <h1>Filtrar Viagens por Interesse</h1>
        <input v-model="interesse" type="text" placeholder="Digite um interesse" />
        <button @click="filtrarViagens">Filtrar</button>

        <div v-if="viagens.length">
            <h3>Viagens encontradas</h3>
            <div v-for="viagem in viagens" :key="viagem.id">
                <p>{{ viagem.cidade }} - {{ viagem.pais }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            interesse: '',
            viagens: []
        };
    },
    methods: {
        filtrarViagens() {
            axios.get(`/api/viagens/interesse/${this.interesse}`)
                .then(response => {
                    this.viagens = response.data;
                });
        }
    }
}
</script>
