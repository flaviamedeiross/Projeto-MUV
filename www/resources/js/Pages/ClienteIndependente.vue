<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- Espacamento atras da navbar -->
            <div class="relative size-12">
                <div class="absolute inset-x-0 top-0 h-16"></div>
            </div>
            <nav class="bg-indigo-950 border-b border-gray-100 fixed top-0 right-0 left-0 z-50">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
                    <div class="flex justify-between h-12">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <img :src="'/storage/images/logo_dark.jpeg'" alt="Logo" class="h-10" />
                            </div>

                            <!-- Navigation Links -->
                            <div class="text-white hidden sm:mt-3 sm:ml-4 sm:flex">
                                <a :href="route('dashboard')">Home</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('cadastro.cliente')" :active="route().current('cadastro.cliente')">
                            Cadastro Cliente
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>
                    
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 font-bold">
                    <h2>Cadastro de Cliente</h2>
                </div>
            </header>
            <main>         
                
            <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>

            <div class="py-6 flex items-center justify-center"> 
                <div class="mt-2 py-6 max-w-4xl mx-auto bg-white w-[500px] rounded shadow">
                    <div class="leading-relaxed text-center">
                            <!-- Exibir mensagem de sucesso -->
                            <div v-if="message" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                {{ message }}
                            </div>

                            <!-- Exibir mensagem de erro -->
                            <div v-if="errorMessage" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                {{ errorMessage }}
                            </div>

                            <div class="leading-relaxed text-center max-w-md mx-auto">
                                <form @submit="submit">
                                    <div class="mt-2">
                                        <label for="nome" class="block text-left mb-2 font-bold">Nome</label>
                                        <input type="text" v-model="form.nome" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.nome" class="text-red-500">{{ errors.nome[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="cep" class="block text-left mb-2 font-bold">CEP</label>
                                        <input type="text" v-model="form.cep" @blur="preencherEndereco" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.cep" class="text-red-500">{{ errors.cep[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="endereco" class="block text-left mb-2 font-bold">Endereço</label>
                                        <input type="text" v-model="form.endereco" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.endereco" class="text-red-500">{{ errors.endereco[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="bairro" class="block text-left mb-2 font-bold">Bairro</label>
                                        <input type="text" v-model="form.bairro" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.bairro" class="text-red-500">{{ errors.bairro[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="cidade" class="block text-left mb-2 font-bold">Cidade</label>
                                        <input type="text" v-model="form.cidade" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.cidade" class="text-red-500">{{ errors.cidade[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="estado" class="block text-left mb-2 font-bold">Estado</label>
                                        <input type="text" v-model="form.estado" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.estado" class="text-red-500">{{ errors.estado[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="telefone" class="block text-left mb-2 font-bold">Telefone</label>
                                        <input type="text" v-model="form.telefone" @input="formatarTelefone" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.telefone" class="text-red-500">{{ errors.telefone[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="username" class="block text-left mb-2 font-bold">Usuário</label>
                                        <input type="text" v-model="form.username" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.username" class="text-red-500">{{ errors.username[0] }}</span>
                                    </div>

                                    <div class="mt-2">
                                        <label for="password" class="block text-left mb-2 font-bold">Senha</label>
                                        <input type="password" v-model="form.password" class="w-full px-3 py-2 border rounded" />
                                        <span v-if="errors.password" class="text-red-500">{{ errors.password[0] }}</span>
                                    </div> 

                                    <div class="mt-4">
                                        <button class="bg-indigo-900 text-white px-4 py-2 rounded" :class="{ 'opacity-25': processing }" :disabled="processing">
                                            Cadastrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
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
            processing: false
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
        formatarTelefone(event) {
            // Remove todos os caracteres que não são números
            const valorSomenteNumeros = event.target.value.replace(/\D/g, '');
            // Atualiza o valor no modelo
            this.form.telefone = valorSomenteNumeros;
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
        }
    }
};
</script>