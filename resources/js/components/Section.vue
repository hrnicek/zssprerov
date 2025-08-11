<script setup>
defineProps({
    title: {
        type: String,
        default: 'Rychlé volby',
    },
});
</script>
<template>
    <section>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 lg:col-span-3">
                    <h3 class="text-2xl font-bold text-brand-primary">
                        {{ title }}
                    </h3>
                </div>
                <div class="col-span-12 lg:col-span-9">
                    <slot />
                </div>
            </div>
        </div>
    </section>
</template>
