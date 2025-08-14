<script setup>
import AppContent from '@/components/AppContent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    careers: {
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
        title: 'Kariéra',
    },
]);
</script>
<template>
    <Head title="Volné pracovní pozice"></Head>

    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <div>
                <h1 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">Volné pracovní pozice</h1>
            </div>
            <div v-if="props.careers.length">
                <div v-for="career in props.careers" :key="career.id">
                    <h2 class="mb-2 text-lg font-bold text-brand-primary">{{ career.title }}</h2>
                    <p class="mb-4">{{ career.description }}</p>
                </div>
            </div>
            <div v-else>
                <p>Není aktuálně otevřené žádné pracovní pozice.</p>
            </div>
        </AppContent>
    </AppLayout>
</template>
