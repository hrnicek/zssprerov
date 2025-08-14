<script setup lang="ts">
import Hero from '@/components/Hero.vue';

import SectionAbout from '@/components/SectionAbout.vue';
import SectionCareers from '@/components/SectionCareers.vue';
import SectionConsumers from '@/components/SectionConsumers.vue';
import SectionDocuments from '@/components/SectionDocuments.vue';
import SectionMap from '@/components/SectionMap.vue';
import SectionMenu from '@/components/SectionMenu.vue';
import SectionQuickOption from '@/components/SectionQuickOption.vue';

import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    establishments: {
        type: Array,
        default: () => [],
    },
    posts: {
        type: Array,
        default: () => [],
    },
    documents: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Úvod"></Head>
    <AppLayout>
        <Hero :posts="posts" />
        <SectionQuickOption />
        <SectionAbout />
        <SectionConsumers />
        <SectionMenu :establishments="props.establishments" />
        <SectionDocuments :documents="documents" />
        <SectionCareers />
        <SectionMap />
    </AppLayout>
</template>
