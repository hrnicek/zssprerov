<script setup>
import AppContent from '@/components/AppContent.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
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
            <div class="max-w-4xl">
                <h1 class="mb-8 text-3xl font-bold text-brand-primary">Kontakt</h1>

                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Company Information -->
                    <Card>
                        <CardHeader>
                            <CardTitle>Kontaktní údaje</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <div>
                                <h3 class="font-bold text-gray-900">Zařízení školního stravování Přerov</h3>
                            </div>
                            <div class="text-gray-700">
                                <p>Kratochvílova 30</p>
                                <p>Přerov</p>
                                <p>750 02</p>
                            </div>
                            <div class="pt-2">
                                <p class="t text-sm"><span class="font-bold">IČO:</span> 49558277</p>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Contact Methods -->
                    <Card>
                        <CardHeader>
                            <CardTitle>Způsoby kontaktu</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                                <div>
                                    <p class="font-bold">E-mail</p>
                                    <a href="mailto:info@zssprerov.cz" class="text-brand-primary hover:underline"> info@zssprerov.cz </a>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="font-bold">Adresa</p>
                                    <p class="text-gray-700">Kratochvílova 30, 750 02 Přerov</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Additional Information -->
                <Card class="mt-8">
                    <CardHeader>
                        <CardTitle>Provozní informace</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-gray-700">
                            Zařízení školního stravování Přerov zajišťuje stravování pro školy a školská zařízení v Přerově a okolí. Pro více informací o
                            stravování, jídelníčcích nebo registraci nás neváhejte kontaktovat.
                        </p>
                    </CardContent>
                </Card>
            </div>
        </AppContent>
    </AppLayout>
</template>
