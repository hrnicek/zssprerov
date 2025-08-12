<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs = ref([
    {
        title: 'Úvod',
        href: '/',
    },
    {
        title: 'Strávníci',
    },
]);

// FAQ data
const faqItems = ref([
    {
        id: 1,
        question: 'Jak se přihlásit ke stravování?',
        answer: 'Přihlášení ke stravování je velmi jednoduché. Stačí si stáhnout formulář z našich stránek, vyplnit jej a zaslat nám buď elektronicky nebo osobně.',
        isOpen: false,
    },
    {
        id: 2,
        question: 'Jaké jsou platební možnosti?',
        answer: 'Nabízíme několik způsobů platby - bankovní převod, platbu v hotovosti v naší kanceláři nebo prostřednictvím platebního systému na našich webových stránkách.',
        isOpen: false,
    },
    {
        id: 3,
        question: 'Lze objednat dietní stravu?',
        answer: 'Ano, nabízíme různé druhy dietních jídel včetně diabetické, šetřící nebo žlučníkové stravy.',
        isOpen: false,
    },
    {
        id: 4,
        question: 'Jak funguje rozvoz jídla?',
        answer: 'Rozvoz zajišťujeme pro seniory a osoby se sníženou mobilitou. Jídlo dodáváme v termosech přímo až domů.',
        isOpen: false,
    },
    {
        id: 5,
        question: 'Co když potřebuji zrušit obědovou porci?',
        answer: 'Odhlášení je možné do 8:00 ráno předchozího pracovního dne prostřednictvím našeho online systému, telefonicky nebo e-mailem.',
        isOpen: false,
    },
    {
        id: 6,
        question: 'Kolik stojí jídlo pro děti?',
        answer: 'Ceny jídel se liší podle věkové kategorie. Aktuální ceník najdete v sekci dokumenty.',
        isOpen: false,
    },
]);

const toggleFaq = (id: number) => {
    const item = faqItems.value.find((item) => item.id === id);
    if (item) {
        item.isOpen = !item.isOpen;
    }
};
</script>

<template>
    <Head title="Strávníci"></Head>
    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <h1 class="mb-4 text-2xl font-bold text-brand-primary">Strávníci</h1>

            <!-- Hero Image -->
            <div class="mb-8">
                <img src="/img/stravnici.jpg" alt="Strávníci" class="h-[600px] w-full object-cover" />
            </div>

            <div class="flex flex-col space-y-16">
                <div>
                    <p class="mb-8 text-base leading-relaxed">
                        Zajišťujeme každodenní stravování pro děti, žáky, studenty, zaměstnance i seniory. Každý den připravujeme čerstvá, chutná a
                        nutričně vyvážená jídla v souladu s věkovými potřebami i specifickými dietními požadavky. Nabízíme pohodlné objednávání,
                        přehledný výdej i individuální přístup ke každé skupině strávníků.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-x-8 lg:grid-cols-3">
                    <div>
                        <div>ikona</div>
                        <h4 class="font-bold">Bezstarostný servis</h4>
                        <p>Díky inkasu se nemusíte o nic starat – objednáváme a stravujeme automaticky.</p>
                    </div>
                    <div>
                        <div>ikona</div>
                        <h4 class="font-bold">Flexibilita</h4>
                        <p>Možnost hotovostní platby, online objednávek i stravy "to-go" v krabičkách.</p>
                    </div>
                    <div>
                        <div>ikona</div>
                        <h4 class="font-bold">Zdravá volba</h4>
                        <p>Dietní nabídka, čerstvé suroviny a projekt „Zdravá školní jídelna“ nám pomáhá dodržovat kvalitní standardy</p>
                    </div>
                </div>
                <div>
                    <h4>Informace pro nové i stávající strávníky</h4>
                    <div>
                        <p>
                            Ať už se ke školnímu stravování přidáváte poprvé, nebo už jste jeho součástí, najdete zde veškeré praktické informace na
                            jednom místě. Dozvíte se, jak se ke stravování přihlásit, jaké máte možnosti úhrady, jak objednávat nebo odhlašovat obědy
                            a co dělat v případě dietních potřeb. Naším cílem je, aby bylo stravování pro děti i dospělé co nejpohodlnější, přehledné
                            a vstřícné k vašim každodenním potřebám.
                        </p>
                    </div>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>
