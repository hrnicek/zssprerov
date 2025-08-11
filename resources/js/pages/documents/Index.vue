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
        title: 'Dokumenty',
    },
]);
</script>
<template>
    <Head title="Dokumenty ke satžení"></Head>

    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <div>
                <h1>Dokumenty</h1>
            </div>
        </AppContent>
    </AppLayout>
</template>
