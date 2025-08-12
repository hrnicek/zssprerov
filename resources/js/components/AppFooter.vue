<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <footer class="mt-16 bg-brand-dark-blue pt-12 pb-8 text-white print:hidden">
        <div class="container mx-auto">
            <div class="grid grid-cols-12">
                <div>
                    <div>
                        <img src="/img/logo-white.svg" alt="logo" />
                    </div>
                </div>
                <div class="col-span-5 col-start-7">
                    <div class="flex justify-between">
                        <div>
                            <nav role="navigation">
                                <ul class="flex flex-col gap-y-4">
                                    <li>
                                        <Link :href="route('about')" class="font-bold text-white hover:text-brand-primary">O nás</Link>
                                    </li>
                                    <li>
                                        <Link :href="route('menu')" class="font-bold text-white hover:text-brand-primary">Jídelníčky</Link>
                                    </li>
                                    <li>
                                        <Link :href="route('documents')" class="font-bold text-white hover:text-brand-primary">Dokumenty</Link>
                                    </li>
                                    <li>
                                        <Link :href="route('consumers')" class="font-bold text-white hover:text-brand-primary">Strávnici</Link>
                                    </li>
                                    <li>
                                        <Link :href="route('careers')" class="font-bold text-white hover:text-brand-primary">Kariéra</Link>
                                    </li>
                                    <li>
                                        <Link :href="route('contact')" class="font-bold text-white hover:text-brand-primary">Kontakt</Link>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div>
                            <p class="mb-3 font-bold">Zařízení školního stravování Přerov</p>
                            <div>
                                E-mail: <a href="mailto:info@zssprerov.cz" class="font-bold hover:underline">info@zssprerov.cz</a><br />
                                Telefon: <a href="tel:+420777888999" class="font-bold hover:underline">+420 777 888 999</a><br /><br />
                                IČO: <span class="font-bold">49558277</span><br /><br />
                                Kratochvílova 30<br> Přerov<br></br> 750 02
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-brand-light-blue">
                <p>2025 © Zařízení školního stravování Přerov • Všechna práva vyhrazena</p>
            </div>
        </div>
    </footer>
</template>
