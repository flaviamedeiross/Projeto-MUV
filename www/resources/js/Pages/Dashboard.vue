<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>

    <!--comando abaixo verifica quais sao os roles e permission do user logado-->
    <!--
    <div>
        {{ $page.props }}
    </div>
    -->

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Olá, {{ $page.props.auth.user.nome }}
            </h2>
        </template>

        <div v-if="$page.props.user.roles.includes('secretaria')">

            <Head title="Funcionario"></Head>           

            <div class="py-5"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="/register" class="text-black-600 hover:text-black-800 font-bold text-lg">Registro de funcionarios</a>
                            <h1 class="ml-4 mt-2">Clique aqui e faça o registro de novos funcionarios.</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-0"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('cadastrocliente')" class="text-black-600 hover:text-black-800 font-bold text-lg">Cadastro de clientes</a>
                            <h1 class="ml-4 mt-2">Clique aqui e cadastre um novo cliente</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('viagens.create')" class="text-black-600 hover:text-black-800 font-bold text-lg">Cadastro de Viagens</a>
                            <p class="ml-4 mt-2 text-gray-700"> Clique aqui para cadastrar novas viagens.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('sugests.create')" class="text-black-600 hover:text-black-800 font-bold text-lg">Cadastro de Sugestões</a>
                            <p class="ml-4 mt-2 text-gray-700"> Adicione sugestões enviadas pelos clientes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('reservas.create')" class="text-black-600 hover:text-black-800 font-bold text-lg">Realizar Reservas</a>
                            <p class="ml-4 mt-2 text-gray-700"> Realize uma reserva para um cliente.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-0">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('reservas.index')" class="text-black-600 hover:text-black-800 font-bold text-lg">Consultar Viagens e Sugestões</a>
                            <p class="ml-4 mt-2 text-gray-700"> Veja o histórico de viagens e sugestões feitas pelos clientes.</p>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        
        <div v-if="$page.props.user.roles.includes('cliente')">

            <Head title="Cliente"></Head>
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('cliente.edit')" class="text-black-600 hover:text-blue-800 font-bold text-lg">Editar Perfil</a>
                            <p class="ml-4 mt-2 text-gray-700"> Atualize seus dados pessoais e informações de contato.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="$page.props.user.roles.includes('cliente')">
                <div class="py-0"> 
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <a :href="route('cliente.viagens')" class="text-blue-600 hover:text-blue-800 font-bold text-lg">Minhas Viagens</a>
                                <p class="ml-4 mt-2 text-gray-700"> Veja todas as viagens que você já comprou.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="py-5">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg hover:shadow-md transition duration-300">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <a :href="route('cliente.futuras')" class="text-blue-600 hover:text-blue-800 font-bold text-lg">Próximas Viagens</a>
                                <p class="ml-4 mt-2 text-gray-700"> Consulte suas próximas viagens agendadas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </AuthenticatedLayout>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                nome: '',
                cep: '',
                endereco: '',
                bairro: '',
                cidade: '',
                estado: '',
                telefone: '',
                username: '',
                password: ''
            },
            errors: {},
            processing: false,
            notificacoes: [],
            hasTrips: false,
        };
    },
    methods: {
        async preencherEndereco() {
            if (this.form.cep.length === 8) {
                try {
                    const response = await fetch(`https://viacep.com.br/ws/${this.form.cep}/json/`);
                    const data = await response.json();
                    if (data.erro) {
                        this.errors.cep = ['CEP inválido.'];
                    } else {
                        this.form.endereco = data.logradouro;
                        this.form.bairro = data.bairro;
                        this.form.cidade = data.localidade;
                        this.form.estado = data.uf;
                    }
                } catch (error) {
                    console.error('Erro ao preencher endereço:', error);
                }
            }
        },
        async submit(event) {
            event.preventDefault();
            this.processing = true;
            try {
                const response = await axios.post('/clientes', this.form);
                alert(response.data.message);
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },
    },
};
</script>

<style>
.min-h-screen {
  min-height: 100vh;
}
.btn {
  transition: all 0.3s;
}
.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}
</style>
