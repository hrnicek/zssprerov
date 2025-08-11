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
        title: 'Kontakt',
    },
]);
</script>
<template>
    <Head title="Kontakt"></Head>
    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <div>
                <h1>Kontakt</h1>
            </div>
        </AppContent>
    </AppLayout>
</template>
