<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
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
            <!-- Hero Image -->
            <div class="mb-8">
                <img src="/img/stravnici.jpg" alt="Strávníci" class="w-full h-64 object-cover rounded-lg" />
            </div>

            <!-- Main Content -->
            <div class="prose max-w-none">
                <p class="text-gray-700 text-base leading-relaxed mb-8">
                    Zajišťujeme každodenní stravování pro děti, žáky, studenty, zaměstnance i seniory. Každý den připravujeme čerstvá, chutná a nutričně
                    vyvážená jídla v souladu s věkovými potřebami i specifickými dietními požadavky. Nabízíme pohodlné objednávání, přehledný výdej i
                    individuální přístup ke každé skupině strávníků.
                </p>
            </div>

            <!-- Consumer Types Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
                <Card class="border border-gray-200">
                    <CardHeader class="pb-4">
                        <CardTitle class="text-brand-primary text-lg font-semibold">Senioři</CardTitle>
                        <CardDescription class="text-sm text-gray-600">
                            Nabízíme pohodlné stravování pro seniory s rozvojem až domů. Dietní varianty pro různé zdravotní potřeby.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="flex justify-end mb-4">
                            <img src="/img/piktogram-seniori-verejnost.svg" alt="Senioři" class="h-12 w-12" />
                        </div>
                        <Button size="sm" class="w-full">Přihlásit se ke stravování</Button>
                    </CardContent>
                </Card>

                <Card class="border border-gray-200">
                    <CardHeader class="pb-4">
                        <CardTitle class="text-brand-primary text-lg font-semibold">Zaměstnanci</CardTitle>
                        <CardDescription class="text-sm text-gray-600">
                            Kvalitní obědy pro zaměstnance firem a organizací. Flexibilní objednávkový systém a výhodné ceny.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="flex justify-end mb-4">
                            <img src="/img/piktogram-studenti.svg" alt="Zaměstnanci" class="h-12 w-12" />
                        </div>
                        <Button size="sm" variant="outline" class="w-full">Strava.cz</Button>
                    </CardContent>
                </Card>

                <Card class="border border-gray-200">
                    <CardHeader class="pb-4">
                        <CardTitle class="text-brand-primary text-lg font-semibold">Žáci a studenti</CardTitle>
                        <CardDescription class="text-sm text-gray-600">
                            Obědy pro děti v MŠ, ZŠ a SŠ. Vyvážené porce, pestrý jídelníček a možnost dietního stravování.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="flex justify-end mb-4">
                            <img src="/img/piktogram-studenti.svg" alt="Studenti" class="h-12 w-12" />
                        </div>
                        <Button size="sm" variant="outline" class="w-full">Strava.cz</Button>
                    </CardContent>
                </Card>
            </div>

            <!-- Informace pro nové a stávající strávníky -->
            <div class="bg-orange-50 border-l-4 border-orange-400 p-6 mb-8">
                <h2 class="text-xl font-semibold text-orange-800 mb-4">Informace pro nové a stávající strávníky</h2>
                <p class="text-gray-700 mb-4">
                    Pro všechny nové strávníky je nutné řádné zaregistrování, bez kterého nelze stravování začít. Formuláře ke stažení
                    najdete v dokumentech na této stránce. Registrace je jedorázová, poté pouze doplačujete kredit.
                </p>
                <p class="text-gray-700 mb-4">
                    Pokud máte zájem o stravování, můžete nás kontaktovat telefonicky nebo navštívit naši výdejnu. Rádi vám zodpovíme
                    všechny otázky.
                </p>
                <div class="flex flex-wrap gap-3">
                    <Button size="sm" class="bg-orange-600 hover:bg-orange-700">Přihlásit se ke stravování</Button>
                    <Button size="sm" variant="outline" class="border-orange-600 text-orange-600">Stáhnout formulář</Button>
                </div>
            </div>

            <!-- Služby -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-brand-primary mb-6">Naše služby</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-2">Pravidelné stravování</h3>
                        <p class="text-sm text-gray-600">Každodenní připravování čerstvých obědů s možností dlouhodobého předplatného</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-2">Dietní strava</h3>
                        <p class="text-sm text-gray-600">Specializované jídelníčky pro různé zdravotní potřeby a dietní omezení</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 3H3m4 10v6a1 1 0 001 1h6a1 1 0 001-1v-6m-6 0h6"></path>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-2">Rozvoz jídla</h3>
                        <p class="text-sm text-gray-600">Dovoz teplých obědů až k vám domů, včetně víkendů a svátků</p>
                    </div>
                </div>
            </div>

            <!-- Základní služby -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-brand-primary mb-6">Základní služby</h2>
                <div class="prose max-w-none">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Pravidelné stravování</h3>
                    <p class="text-gray-700 mb-4">
                        Nabízíme komplexní stravovací služby pro všechny věkové kategorie. Naše kuchyně připravuje každý den čerstvá jídla
                        s důrazem na kvalitu surovin a vyvážené složení stravy.
                    </p>

                    <h3 class="text-lg font-medium text-gray-900 mb-3">Dietní stravování</h3>
                    <p class="text-gray-700 mb-4">
                        Pro strávníky se speciálními dietními potřebami nabízíme dietní varianty jídel. Sestavujeme je v souladu s doporučeními
                        odborníků a lékařskými požadavky.
                    </p>

                    <h3 class="text-lg font-medium text-gray-900 mb-3">Rozvoz domů</h3>
                    <p class="text-gray-700 mb-6">
                        Pro seniory a osoby s omezenou mobilitou zajišťujeme rozvoz teplých jídel přímo do domácnosti. Rozvážíme i o víkendech
                        a svátcích, aby se naši strávníci nemuseli o nic starat.
                    </p>
                </div>
            </div>

            <!-- Moderní jídelna strávníků -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-brand-primary mb-6">Moderní jídelna strávníků</h2>
                <p class="text-gray-700 mb-6">
                    Naše moderní jídelna nabízí příjemné prostředí pro konzumaci jídel. Disponujeme dostatečnou kapacitou a komfortním
                    zázemím pro všechny naše strávníky.
                </p>
                <Button>Zobrazit fotogalerii</Button>
            </div>

            <!-- Ceny fakultní stravy -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-brand-primary mb-6">Ceny fakultní stravy</h2>
                <p class="text-gray-700 mb-4">
                    Aktuální ceník najdete v sekci Dokumenty. Ceny jsou stanoveny podle typu stravy a věkové kategorie strávníka.
                </p>

                <h3 class="text-lg font-medium text-gray-900 mb-3">Jak se připojit?</h3>
                <p class="text-gray-700 mb-4">
                    Pokud máte zájem o naše stravovací služby, neváhejte nás kontaktovat. Rádi vám zodpovíme všechny dotazy a pomůžeme
                    s registrací.
                </p>

                <h3 class="text-lg font-medium text-gray-900 mb-3">Způsoby plateb díky stravě</h3>
                <p class="text-gray-700 mb-6">
                    Platby můžete provádět několika způsoby - v hotovosti, bankovním převodem nebo prostřednictvím našeho online systému.
                    Pro školáky nabízíme čipový platební systém.
                </p>
            </div>

            <!-- FAQ Section -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-brand-primary mb-6">Často kladené otázky</h2>
                <div class="space-y-3">
                    <div v-for="item in faqItems" :key="item.id">
                        <Collapsible v-model:open="item.isOpen">
                            <CollapsibleTrigger
                                @click="toggleFaq(item.id)"
                                class="flex w-full items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-3 text-left hover:bg-gray-50 focus:ring-2 focus:ring-brand-primary focus:ring-offset-2 focus:outline-none"
                            >
                                <span class="font-medium text-gray-900 text-sm">{{ item.question }}</span>
                                <svg
                                    class="h-4 w-4 text-gray-500 transition-transform duration-200"
                                    :class="{ 'rotate-180': item.isOpen }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </CollapsibleTrigger>
                            <CollapsibleContent
                                class="overflow-hidden data-[state=closed]:animate-collapsible-up data-[state=open]:animate-collapsible-down"
                            >
                                <div class="px-4 pt-2 pb-3 text-gray-600 text-sm">
                                    {{ item.answer }}
                                </div>
                            </CollapsibleContent>
                        </Collapsible>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-brand-primary text-white rounded-lg p-8 text-center">
                <h2 class="text-xl font-semibold mb-4">Připojte se k nám</h2>
                <p class="mb-6 opacity-90">
                    Začněte se zdravě stravovat už dnes. Přihlaste se ke stravování a užívejte si chutná a vyvážená jídla každý den.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <Button size="lg" variant="secondary" class="bg-white text-brand-primary hover:bg-gray-100">
                        Kontakt
                    </Button>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>
