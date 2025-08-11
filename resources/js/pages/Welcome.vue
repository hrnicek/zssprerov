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
</script>

<template>
    <Head title="Úvod"></Head>
    <AppLayout>
        <Hero />
        <SectionQuickOption />
        <SectionAbout />
        <SectionConsumers />
        <SectionMenu />
        <SectionDocuments />
        <SectionCareers />
        <SectionMap />
    </AppLayout>
</template>
