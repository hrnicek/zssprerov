<script setup>
import Button from '@/components/ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <header class="print:hidden">
        <div class="container mx-auto border-b-2 border-brand-beige px-4">
            <div class="flex items-end justify-between bg-white py-6">
                <div>
                    <Link href="/">
                        <img src="/img/logo.svg" alt="logo" />
                    </Link>
                </div>
                <div class="flex justify-end">
                    <div>
                        <div class="mb-8 flex justify-end space-x-4">
                            <Button variant="outline" as="a" href="https://app.strava.cz/zalozit-ucet?jidelna" target="_blank" type="primary">
                                Nový strávník
                            </Button>
                            <Button variant="outline" as="a" href="https://strava.cz/" target="_blank" type="primary"> Strava.cz </Button>
                        </div>
                        <nav role="navigation" class="hidden lg:flex">
                            <ul class="flex space-x-6">
                                <li>
                                    <Link
                                        :href="route('about')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >O nás</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="route('menu')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >Jídelníčky</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="route('documents')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >Dokumenty</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="route('consumers')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >Strávnici</Link
                                    >
                                </li>
                                <!-- <li>
                                    <Link
                                        :href="route('pricing')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >Ceník</Link
                                    >
                                </li> -->
                                <li>
                                    <Link
                                        :href="route('careers')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >Kariéra</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="route('contact')"
                                        class="rounded-full px-4 py-2.5 text-lg font-bold text-brand-dark-blue hover:bg-brand-primary hover:text-white"
                                        >Kontakt</Link
                                    >
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
