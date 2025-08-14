<script setup>
import AppContent from '@/components/AppContent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    documents: {
        type: Array,
        default: () => [],
    },
});

const breadcrumbs = ref([
    {
        title: 'Úvod',
        href: '/',
    },
    {
        title: 'Dokumenty',
    },
]);
</script>
<template>
    <Head title="Dokumenty ke satžení"></Head>

    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <div>
                <h1 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">Dokumenty</h1>
            </div>
            <div class="mt-12 grid grid-cols-1 gap-x-16 gap-y-4 lg:grid-cols-2">
                <div v-for="document in documents" :key="document.id">
                    <div @click="download(document.media[0])" class="group flex items-center space-x-4 hover:cursor-pointer">
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M12.9999 11.5858L16.2928 8.29289L17.707 9.70711L12.707 14.7071C12.3165 15.0976 11.6833 15.0976 11.2928 14.7071L6.29282 9.70711L7.70703 8.29289L10.9999 11.5858L10.9999 3L12.9999 3L12.9999 11.5858Z"
                                    fill="#003E53"
                                />
                                <path
                                    d="M3 13V19C3 19.5523 3.44772 20 4 20H20C20.5523 20 21 19.5523 21 19V13"
                                    stroke="#003E53"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                        <div class="group-hover:underline">
                            <p>{{ document.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>
