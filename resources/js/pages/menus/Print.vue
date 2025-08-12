<script setup>
import AppContent from '@/components/AppContent.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    establishments: {
        type: Array,
        default: () => [],
    },
    menuData: {
        type: Array,
        default: () => [],
    },
    selectedEstablishment: {
        type: Object,
        default: null,
    },
    printDate: {
        type: String,
        default: '',
    },
});

const printPage = () => {
    window.print();
};

const getAllergenList = () => {
    return [
        { code: '01a', name: 'Obiloviny obsahující lepek' },
        { code: '01b', name: 'Obiloviny - pšenice' },
        { code: '01c', name: 'Obiloviny - žito' },
        { code: '03', name: 'Obiloviny - ječmen' },
        { code: '04', name: 'Vejce' },
        { code: '06', name: 'Ryby' },
        { code: '07', name: 'Sójové boby (sója)' },
        { code: '08', name: 'Mléko' },
        { code: '09', name: 'Ořechy, mandle, pistácie' },
        { code: '10', name: 'Celer' },
        { code: '11', name: 'Hořčice' },
        { code: '12', name: 'Sezamová semena' },
        { code: 'J', name: 'Oxid siřičitý a siřičitany' },
    ];
};

// Auto-print when component mounts (optional)
onMounted(() => {
    setTimeout(() => printPage(), 1000);
});
</script>

<template>
    <Head title="Tisk jídelníčku" />

    <AppLayout>
        <AppContent>
            <!-- Print Controls (hidden when printing) -->
            <div class="mb-6 flex items-center justify-between print:hidden">
                <h1 class="text-2xl font-bold text-gray-900">Tisk jídelníčku</h1>
                <div class="flex gap-3">
                    <Button @click="printPage" class="flex items-center gap-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                            />
                        </svg>
                        Tisknout
                    </Button>
                    <Button variant="outline" @click="$inertia.visit('/jidelnicky')"> Zpět na jídelníček </Button>
                </div>
            </div>

            <!-- Print Header -->
            <div class="mb-8">
                <div class="mb-6 text-center">
                    <h1 class="mb-2 text-3xl font-bold text-gray-900">Jídelníček</h1>
                    <h2 v-if="selectedEstablishment" class="mb-2 text-xl text-gray-700">
                        {{ selectedEstablishment.name }}
                    </h2>
                    <p class="text-sm text-gray-600">Vytištěno: {{ printDate }}</p>
                </div>
            </div>

            <!-- Menu Table -->
            <div v-if="menuData && menuData.length > 0" class="mb-8">
                <div class="overflow-hidden border border-gray-300">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="w-24 border border-gray-300 px-4 py-3 text-left font-semibold text-gray-900">Den</th>
                                <th class="w-32 border border-gray-300 px-4 py-3 text-left font-semibold text-gray-900">Jídlo</th>
                                <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-900">Menu</th>
                                <th class="w-24 border border-gray-300 px-4 py-3 text-left font-semibold text-gray-900">Alergeny</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(day, dayIndex) in menuData" :key="dayIndex">
                                <template v-for="(meals, mealType, mealIndex) in day.meals" :key="`${dayIndex}-${mealType}`">
                                    <tr
                                        v-for="(meal, mealItemIndex) in meals"
                                        :key="`${dayIndex}-${mealType}-${mealItemIndex}`"
                                        class="hover:bg-gray-50"
                                    >
                                        <!-- Day column - only show for first meal of the day -->
                                        <td
                                            v-if="mealIndex === 0 && mealItemIndex === 0"
                                            :rowspan="Object.values(day.meals).flat().length"
                                            class="border border-gray-300 bg-gray-50 px-4 py-3 align-top text-sm font-medium text-gray-900"
                                        >
                                            <div class="font-semibold">{{ day.day }}</div>
                                            <div class="text-xs text-gray-600">{{ day.date }}</div>
                                        </td>

                                        <!-- Meal type column - only show for first item of each meal type -->
                                        <td
                                            v-if="mealItemIndex === 0"
                                            :rowspan="meals.length"
                                            class="border border-gray-300 px-4 py-3 align-top text-xs font-medium text-gray-700"
                                        >
                                            {{ mealType }}
                                        </td>

                                        <!-- Menu item -->
                                        <td class="border border-gray-300 px-4 py-3 text-xs text-gray-900">
                                            {{ meal.menu }}
                                        </td>

                                        <!-- Allergens -->
                                        <td class="border border-gray-300 px-4 py-3 text-xs text-gray-600">
                                            {{ meal.allergens || '-' }}
                                        </td>
                                    </tr>
                                </template>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- No Data Message -->
            <div v-else class="py-12 text-center">
                <p class="text-lg text-gray-500">Nejsou k dispozici žádná data jídelníčku pro tisk.</p>
            </div>

            <!-- Allergen Legend -->
            <div class="page-break-before mt-8">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">Seznam alergenů</h3>
                <div class="grid grid-cols-1 gap-2 text-sm md:grid-cols-2">
                    <div v-for="allergen in getAllergenList()" :key="allergen.code" class="flex items-start gap-3">
                        <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-xs font-semibold">
                            {{ allergen.code }}
                        </span>
                        <span class="text-gray-700">{{ allergen.name }}</span>
                    </div>
                </div>

                <div class="mt-6 border-t border-gray-200 pt-4">
                    <p class="text-center text-xs text-gray-600">Změna jídelního lístku a alergenů vyhrazena !!! Pokrm je určen k přímé spotřebě</p>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>

<style>
/* Print-specific styles */
@media print {
    @page {
        margin: 1cm;
        size: A4;
    }

    body {
        font-size: 12px;
        line-height: 1.4;
    }

    .page-break-before {
        page-break-before: always;
    }

    table {
        page-break-inside: auto;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    thead {
        display: table-header-group;
    }

    .print\:hidden {
        display: none !important;
    }
}
</style>
