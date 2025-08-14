<script setup>
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Select } from '@/components/ui/select';
import { router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import Section from './Section.vue';
import Button from './ui/button/Button.vue';

const props = defineProps({
    establishments: {
        type: Array,
        default: () => [],
    },
});

const options = computed(() => {
    return props.establishments.map((establishment) => ({
        value: establishment.code,
        label: establishment.name,
    }));
});

const selectedEstablishment = ref('');

const handleEstablishmentChange = (value) => {
    router.get(`/jidelnicky`, {
        jidelna: value,
    });
};
</script>
<template>
    <Section title="Jídelničky" class="py-16">
        <Card class="p-16">
            <CardHeader>
                <p class="mb-4 text-gray-600">Zvolte pobočku a klikněte na datum pro zobrazení jídelníčku.</p>
            </CardHeader>
            <CardContent class="flex">
                <div class="flex-auto">
                    <Select v-model="selectedEstablishment" :options="options" placeholder="Vyberte jídelnu" class="max-w-[400px]" />
                </div>
                <div class="flex justify-end">
                    <img src="/img/piktogram-vyber-zarizeni.svg" />
                </div>
            </CardContent>
            <CardFooter>
                <Button @click="handleEstablishmentChange(selectedEstablishment)"> Zobrazit </Button>
            </CardFooter>
        </Card>
    </Section>
</template>
