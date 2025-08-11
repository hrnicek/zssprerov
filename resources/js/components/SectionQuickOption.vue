<script setup>
import Section from '@/components/Section.vue';
import { Card, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

const options = [
    {
        title: 'Stravne.cz',
        description: 'Odhlaste i přihlaste oběd pohodlně online.',
        link: '/strava',
    },
    {
        title: 'Veřejné smlouvy',
        description: 'Veřejné smlouvy v souladu s platnou legislativou.',
        link: '/strava',
    },
    {
        title: 'Jídelníčky',
        description: 'Aktuální jídelníčky všech jídelen na jednom místě.',
        link: '/strava',
    },
    {
        title: 'Často kladené dotazy',
        description: 'Nejčastější dotazy přehledně na jednom místě.',
        link: '/strava',
    },
    {
        title: 'Provozní řád',
        description: 'Seznamte se s pravidly školního stravování.',
        link: '/strava',
    },
    {
        title: 'Ceníky',
        description: 'Aktuální ceny stravného podle věku a typu strávníka.',
        link: '/strava',
    },
];
</script>
<template>
    <Section title="Rychlé volby" class="py-16">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <Card v-for="option in options" class="bg-brand-beige text-brand-dark-blue">
                <CardHeader>
                    <CardTitle v-html="option.title"></CardTitle>
                    <CardDescription class="text-base text-foreground" v-html="option.description"></CardDescription>
                </CardHeader>
            </Card>
        </div>
    </Section>
</template>
