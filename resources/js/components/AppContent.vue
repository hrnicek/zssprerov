<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import type { BreadcrumbItemType } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <div class="min-h-[300px] py-6 lg:min-h-[600px]">
        <div class="mb-8">
            <div class="container mx-auto px-4">
                <template v-if="breadcrumbs && breadcrumbs.length > 0">
                    <Breadcrumbs :breadcrumbs="breadcrumbs" />
                </template>
            </div>
        </div>

        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 lg:col-span-3"></div>
                <div class="col-span-12 lg:col-span-9">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
