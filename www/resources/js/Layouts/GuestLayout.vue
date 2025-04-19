<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-indigo-100">


        <div class="relative flex items-center">
            <img :src="'/storage/images/logo_dark.jpeg'" alt="Logo" class="h-[270px] sm:rounded-l-lg shadow-md" />
            <div>
                <div class="h-[270px] w-[310px] w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-r-lg">
                    <slot />
                </div>
            </div>
        </div>

    </div>
</template>
