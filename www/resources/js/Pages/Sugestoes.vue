<template>
    <div>
        <h1>Enviar Sugestão</h1>
        <form @submit.prevent="enviarSugestao">
            <input v-model="nome" type="text" placeholder="Nome" required />
            <input v-model="descricao" type="text" placeholder="Descrição" required />
            <input v-model="interesse" type="text" placeholder="Interesse" required />
            <select v-model="trip_id">
                <option v-for="trip in viagens" :key="trip.id" :value="trip.id">
                    {{ trip.cidade }} - {{ trip.pais }}
                </option>
            </select>
            <button type="submit">Enviar Sugestão</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            nome: '',
            descricao: '',
            interesse: '',
            trip_id: null,
            viagens: []
        };
    },
    created() {
        axios.get('/api/viagens').then(response => {
            this.viagens = response.data;
        });
    },
    methods: {
        enviarSugestao() {
            axios.post('/api/sugestao', {
                nome: this.nome,
                descricao: this.descricao,
                interesse: this.interesse,
                trip_id: this.trip_id
            })
            .then(response => {
                alert('Sugestão enviada!');
            })
            .catch(error => {
                alert('Erro ao enviar sugestão!');
            });
        }
    }
}
</script>
