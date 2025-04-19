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
                Cadastro de Cliente
            </h2>
        </template>

        <div v-if="$page.props.user.roles.includes('secretaria')">

            <Head title="Secretaria"></Head>
            
            <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>

            <div class="mt-10 py-6 max-w-4xl mx-auto bg-white w-[500px] rounded shadow">

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

    </AuthenticatedLayout>
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