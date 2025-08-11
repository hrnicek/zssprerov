<script setup>
import AppContent from '@/components/AppContent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
const breadcrumbs = ref([
    {
        title: 'Úvod',
        href: '/',
    },
    {
        title: 'O nás',
    },
]);
</script>
<template>
    <Head title="O nás"></Head>
    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <div>
                <h1>O nás</h1>
            </div>
        </AppContent>
    </AppLayout>
</template>
