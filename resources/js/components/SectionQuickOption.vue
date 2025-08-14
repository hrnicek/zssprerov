<script setup>
import Section from '@/components/Section.vue';
import { Card, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Link } from '@inertiajs/vue3';

const options = [
    {
        title: 'Strava.cz',
        description: 'Odhlaste i přihlaste oběd pohodlně online.',
        link: 'https://strava.cz',
        external: true,
    },
    {
        title: 'Veřejné smlouvy',
        description: 'Veřejné smlouvy v souladu s platnou legislativou.',
        link: 'https://smlouvy.gov.cz/',
        external: true,
    },
    {
        title: 'Jídelníčky',
        description: 'Aktuální jídelníčky všech jídelen na jednom místě.',
        link: '/jidelnicky',
        external: false,
    },
    {
        title: 'Často kladené dotazy',
        description: 'Nejčastější dotazy přehledně na jednom místě.',
        link: '/stravnici#faq',
        external: false,
    },
    {
        title: 'Provozní řád',
        description: 'Seznamte se s pravidly školního stravování.',
        link: '/provozni-rad',
        external: false,
    },
    {
        title: 'Ceníky',
        description: 'Aktuální ceny stravného podle věku a typu strávníka.',
        link: '/ceniky',
        external: false,
    },
];
</script>
<template>
    <Section title="Rychlé volby" class="pt-28 pb-16">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <template v-for="option in options" :key="option.link">
                <Link v-if="!option.external" :href="option.link">
                    <Card class="bg-brand-beige text-brand-dark-blue hover:bg-brand-beige/80">
                        <CardHeader>
                            <CardTitle v-html="option.title"></CardTitle>
                            <CardDescription class="text-base text-foreground" v-html="option.description"></CardDescription>
                        </CardHeader>
                    </Card>
                </Link>
                <a v-else :href="option.link" target="_blank" rel="noopener noreferrer">
                    <Card class="bg-brand-beige text-brand-dark-blue hover:bg-brand-beige/80">
                        <CardHeader>
                            <CardTitle v-html="option.title"></CardTitle>
                            <CardDescription class="text-base text-foreground" v-html="option.description"></CardDescription>
                        </CardHeader>
                    </Card>
                </a>
            </template>
        </div>
    </Section>
</template>
