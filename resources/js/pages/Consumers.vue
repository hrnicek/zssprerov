<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Faq {
    id: number;
    question: string;
    answer: string;
    is_open: boolean;
}

interface Props {
    faqs: Faq[];
}

const props = defineProps<Props>();

const breadcrumbs = ref([
    {
        title: 'Úvodní strana',
        href: '/',
    },
    {
        title: 'Strávníci',
        href: '',
    },
]);

// Transform FAQs from props to include local isOpen state
const faqItems = ref(
    props.faqs.map((faq) => ({
        ...faq,
        isOpen: faq.is_open,
    })),
);

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
                <img src="/img/stravnici.jpg" alt="Strávníci" class="h-[600px] w-full rounded-lg object-cover" />
            </div>

            <!-- Main Content -->
            <div class="flex flex-col space-y-12 lg:space-y-24">
                <!-- Introduction -->
                <div>
                    <p class="mb-8 text-base leading-relaxed lg:pr-32">
                        Naše školní jídelny zajišťují kvalitní a vyváženou stravu pro široké spektrum strávníků. Vaříme pro děti v mateřských školách,
                        žáky základních a středních škol, zaměstnance školských zařízení i cizí strávníky z řad veřejnosti – včetně seniorů. Každý den
                        servírujeme jídla, která splňují přísné výživové normy a podporují zdravý životní styl všech věkových skupin.
                    </p>
                </div>

                <div class="mb-24">
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        <div>
                            <div class="mb-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 20V6C21 4.89543 20.1046 4 19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20Z"
                                        stroke="#003E53"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                    <path d="M6 14H8" stroke="#003E53" stroke-width="2" />
                                    <path d="M7 0L7 7" stroke="#003E53" stroke-width="2" />
                                    <path d="M17 0L17 7" stroke="#003E53" stroke-width="2" />
                                    <path d="M6 18H8" stroke="#003E53" stroke-width="2" />
                                    <path d="M11 14H13" stroke="#003E53" stroke-width="2" />
                                    <path d="M11 18H13" stroke="#003E53" stroke-width="2" />
                                    <path d="M16 14H18" stroke="#003E53" stroke-width="2" />
                                    <path d="M16 18H18" stroke="#003E53" stroke-width="2" />
                                    <path d="M3 10H21.5" stroke="#003E53" stroke-width="2" />
                                </svg>
                            </div>
                            <p class="mb-1 font-bold">Bezstarostný servis</p>
                            <p>Díky inkasu se nemusíte o nic starat – objednáváme a stravujeme automaticky.</p>
                        </div>
                        <div>
                            <div class="mb-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 20V6C21 4.89543 20.1046 4 19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20Z"
                                        stroke="#003E53"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                    <path d="M6 14H8" stroke="#003E53" stroke-width="2" />
                                    <path d="M7 0L7 7" stroke="#003E53" stroke-width="2" />
                                    <path d="M17 0L17 7" stroke="#003E53" stroke-width="2" />
                                    <path d="M6 18H8" stroke="#003E53" stroke-width="2" />
                                    <path d="M11 14H13" stroke="#003E53" stroke-width="2" />
                                    <path d="M11 18H13" stroke="#003E53" stroke-width="2" />
                                    <path d="M16 14H18" stroke="#003E53" stroke-width="2" />
                                    <path d="M16 18H18" stroke="#003E53" stroke-width="2" />
                                    <path d="M3 10H21.5" stroke="#003E53" stroke-width="2" />
                                </svg>
                            </div>
                            <p class="mb-1 font-bold">Flexibilita</p>
                            <p>Možnost hotovostní platby, online objednávek i stravy "to-go" v krabičkách.</p>
                        </div>
                        <div>
                            <div class="mb-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.9961 9C19.9514 7.99072 19.5244 6.99394 18.7151 6.2234C17.0018 4.5922 14.2237 4.5922 12.5105 6.2234L11.4999 7.18554L10.4894 6.2234L10.3255 6.07553C8.60339 4.59403 5.94451 4.64316 4.2848 6.2234C2.62508 7.80364 2.57348 10.3352 4.1295 11.9749L4.2848 12.1309L11.4999 19L13.3037 17.2827"
                                        stroke="#003E53"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        d="M9 12.6667H12.3589L13.7273 10L16.6818 16L18.5876 12.6667H22"
                                        stroke="#003E53"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                            <p class="mb-1 font-bold">Zdravá volba</p>
                            <p>Dietní nabídka, čerstvé suroviny a projekt „Zdravá školní jídelna“ nám pomáhá dodržovat kvalitní standardy.</p>
                        </div>
                    </div>
                </div>

                <!-- Information for new and existing diners -->
                <div>
                    <h2 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">Informace pro nové i stávající strávníky</h2>
                    <p class="max-w-2xl text-base leading-relaxed">
                        Ať už se ke školnímu stravování přidáváte poprvé, nebo už jste jeho součástí, najdete zde veškeré praktické informace na
                        jednom místě. Dozvíte se, jak se ke stravování přihlásit, jaké máte možnosti úhrady, jak objednávat nebo odhlašovat obědy a co
                        dělat v případě dietních potřeb. Naším cílem je, aby bylo stravování pro děti i dospělé co nejpohodlnější, přehledné a
                        vstřícné k vašim každodenním potřebám.
                    </p>
                </div>

                <!-- How to register for catering -->
                <div>
                    <h2 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">Jak se přihlásit ke stravování</h2>
                    <p class="text-base leading-relaxed">
                        Přihlášení ke stravování je jednoduché. Stačí vyplnit přihlášku, zde na webu nebo přímo v jídelně. Při registraci obdržíte
                        stravovací čip (nebo aktivujete ISIC kartu) a zvolíte způsob platby – inkasem z účtu nebo hotově. Po registraci získáte
                        přístup do systému Strava.cz, kde si můžete snadno objednávat a odhlašovat obědy.
                    </p>
                    <div class="mt-12 flex space-x-4">
                        <Button as="a" href="https://app.strava.cz/zalozit-ucet?jidelna" target="_blank" type="primary"> Přihlásit se online </Button>
                        <Button variant="outline" as="a" href="https://strava.cz/" target="_blank" type="primary"> Stáhnout formulář </Button>
                    </div>
                </div>

                <!-- How to cancel lunch -->
                <div>
                    <h2 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">Jak odhlásit oběd</h2>
                    <p class="text-base leading-relaxed">
                        Oběd je možné odhlásit nejpozději den předem do 14:00 – online přes systém Strava.cz, telefonicky nebo osobně na pokladně
                        jídelny. V případě nemoci je možné si první den nepřítomnosti oběd vyzvednout do jídlonosiče.
                    </p>
                </div>

                <!-- Payment methods -->
                <div>
                    <h2 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">Způsob úhrady</h2>

                    <div class="space-y-6">
                        <div>
                            <h3 class="mb-3 text-xl font-semibold text-brand-primary">Platba inkasem</h3>
                            <p class="text-base leading-relaxed">
                                Nejpohodlnější způsob úhrady. Částka za stravné se automaticky strhává z vašeho bankovního účtu vždy na začátku
                                měsíce. Obědy jsou přihlašovány automaticky, není nutné je objednávat ručně.
                            </p>
                        </div>

                        <div>
                            <h3 class="mb-3 text-xl font-semibold text-brand-primary">Platba hotově</h3>
                            <p class="text-base leading-relaxed">
                                Hotově lze platit přímo na pokladně jídelny. Obědy je nutné zaplatit i objednat vždy předem – nejpozději do konce
                                předchozího měsíce. V případě dotazů vám rádi pomůžeme na výdejním místě.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Dietary catering options -->
                <div>
                    <h2 class="text-xl6 mb-6 font-bold text-brand-primary lg:text-2xl">Možnosti dietního stravování</h2>
                    <p class="text-base leading-relaxed">
                        Zařízení školního stravování Přerov nabízí také dietní stravu pro děti i seniory. Pro žáky mateřských, základních a středních
                        škol zajišťujeme bezlepkovou dietu, která je připravována ve školní jídelně na Trávníku 27 a následně rozvážena do
                        jednotlivých škol. Pro seniory je v jídelně na Velké Dlážce 5 k dispozici diabetická, žlučníková a šetřící dieta, a to včetně
                        výdeje o víkendech a svátcích. Dietní pokrmy jsou připravovány dle doporučení lékařů a individuálních potřeb strávníků. V
                        případě zájmu o dietní stravování nás prosím kontaktujte – rádi vám poskytneme podrobnosti k možnostem, podmínkám i postupu
                        přihlášení.
                    </p>
                </div>

                <!-- FAQ Section -->
                <div>
                    <h2 class="mb-6 text-2xl font-bold text-brand-primary">Často kladené otázky</h2>
                    <div class="space-y-4">
                        <div v-for="item in faqItems" :key="item.id" class="border-b border-gray-200 pb-4">
                            <button @click="toggleFaq(item.id)" class="flex w-full items-center justify-between py-4 text-left focus:outline-none">
                                <span class="text-base font-medium">{{ item.question }}</span>
                                <svg
                                    :class="{ 'rotate-180': item.isOpen }"
                                    class="h-5 w-5 transform transition-transform duration-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div v-if="item.isOpen" class="pb-4">
                                <p class="text-base leading-relaxed">{{ item.answer }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12">
                        <p class="mb-8">
                            Nenašli jste odpověď na svou otázku? V případě jakýchkoliv dotazů nebo nejasností jsme vám k dispozici na každém výdejním
                            místě. Jsme tu pro vás – denně, s péčí a důrazem na kvalitní stravování pro všechny věkové kategorie.
                        </p>
                        <Button as="a" href="/kontakt"> Kontaktovat </Button>
                    </div>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>
