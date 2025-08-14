<script setup>
import AppContent from '@/components/AppContent.vue';
import DateSelector from '@/components/DateSelector.vue';
import MenuTable from '@/components/MenuTable.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Select } from '@/components/ui/select';
import { generateCalendarDates } from '@/composables/useCalendar.js';
import { useMenuNavigation } from '@/composables/useMenuNavigation.js';
import { useMenuScroll } from '@/composables/useMenuScroll.js';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

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
        type: [String, Number],
        default: '',
    },
    selectedDates: {
        type: Array,
        default: () => [],
    },
});

watch(
    () => props.selectedEstablishment,
    (newValue) => {
        selectedEstablishment.value = newValue;
    },
);
// Generate calendar data
const calendarWeeks = generateCalendarDates();
const calendarDates = computed(() => {
    return calendarWeeks.flatMap((week) => week.dates);
});

// State management
const selectedEstablishment = ref(props.selectedEstablishment || '');
const selectedDate = ref('');
const showMenu = ref(!!props.menuData && !!selectedEstablishment.value);
const isAllergenDialogOpen = ref(false);

// Composables
const { isScrolling, scrollToDate, selectDate, setupScrollDetection, cleanupScrollDetection } = useMenuScroll();
const { fetchMenuForEstablishment, handleUrlHash } = useMenuNavigation();

// Computed properties
const establishmentOptions = computed(() => {
    return props.establishments.map((establishment) => ({
        value: establishment.code,
        label: establishment.name,
    }));
});

// Event handlers
const handleEstablishmentChange = () => {
    if (selectedEstablishment.value) {
        fetchMenuForEstablishment(selectedEstablishment.value, selectedDate.value);
    }
    showMenu.value = !!selectedEstablishment.value;
};

const handleDateSelect = (dateString) => {
    selectDate(dateString, (date) => {
        selectedDate.value = date;
    });
};

// Lifecycle hooks
onMounted(() => {
    // Initialize with current data
    if (props.selectedEstablishment && props.menuData) {
        selectedEstablishment.value = props.selectedEstablishment;
        showMenu.value = true;
        // Set today as default selected date if no hash is present
        if (!window.location.hash) {
            const today = new Date().toISOString().split('T')[0];
            selectedDate.value = today;
        }
    }

    // Handle URL hash on component mount
    handleUrlHash((date) => {
        selectedDate.value = date;
    }, scrollToDate);

    // Listen for hash changes
    window.addEventListener('hashchange', () => {
        handleUrlHash((date) => {
            selectedDate.value = date;
        }, scrollToDate);
    });

    // Setup scroll detection after a delay to ensure DOM is ready
    setTimeout(() => {
        setupScrollDetection((date) => {
            selectedDate.value = date;
        });
    }, 500);
});

onUnmounted(() => {
    cleanupScrollDetection();
    window.removeEventListener('hashchange', handleUrlHash);
});

const breadcrumbs = ref([
    {
        title: 'Úvod',
        href: '/',
    },
    {
        title: 'Jídelníčky',
    },
]);
</script>

<template>
    <Head title="Jídelníčky"></Head>
    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <h1 class="mb-4 text-2xl font-bold text-brand-primary">Jídelníčky</h1>
            <Card>
                <CardHeader class="p-4">
                    <p class="mb-4 text-gray-600">Zvolte pobočku a klikněte na datum pro zobrazení jídelníčku.</p>
                    {{ props.selectedEstablishment }}
                    <div class="space-y-4">
                        <!-- Establishment Select -->
                        <div>
                            <Select
                                v-model="selectedEstablishment"
                                :options="establishmentOptions"
                                placeholder="Vyberte jídelnu"
                                @update:modelValue="handleEstablishmentChange"
                            />
                        </div>
                    </div>
                </CardHeader>

                <!-- Date Selector -->
                <div v-if="selectedEstablishment" class="px-4 pb-4">
                    <DateSelector
                        :dates="calendarDates"
                        :selected-date="selectedDate"
                        helper-text="Klikněte na datum pro přechod na jídelníček daného dne"
                        @select="handleDateSelect"
                    />
                </div>
            </Card>

            <!-- Menu Display -->
            <div v-if="showMenu && props.menuData && props.menuData.length > 0" class="mt-8">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Jídelníček</h3>
                    <div class="flex gap-3">
                        <Dialog v-model:open="isAllergenDialogOpen">
                            <DialogTrigger as-child>
                                <Button variant="outline" size="sm" class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                    Seznam alergenů
                                </Button>
                            </DialogTrigger>
                            <DialogContent class="max-w-2xl">
                                <DialogHeader>
                                    <DialogTitle>Seznam alergenů</DialogTitle>
                                </DialogHeader>
                                <div class="grid gap-4 py-4">
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div class="space-y-3">
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold"
                                                    >01a</span
                                                >
                                                <span class="text-sm">Obiloviny obsahující lepek</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold"
                                                    >01b</span
                                                >
                                                <span class="text-sm">Obiloviny - pšenice</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold"
                                                    >01c</span
                                                >
                                                <span class="text-sm">Obiloviny - žito</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">03</span>
                                                <span class="text-sm">Obiloviny - ječmen</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">04</span>
                                                <span class="text-sm">Vejce</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">06</span>
                                                <span class="text-sm">Ryby</span>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">07</span>
                                                <span class="text-sm">Sójové boby (sója)</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">08</span>
                                                <span class="text-sm">Mléko</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">09</span>
                                                <span class="text-sm">Ořechy, mandle, pistácie</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">10</span>
                                                <span class="text-sm">Celer</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">11</span>
                                                <span class="text-sm">Hořčice</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">12</span>
                                                <span class="text-sm">Sezamová semena</span>
                                            </div>
                                            <div class="flex items-start gap-3">
                                                <span class="min-w-[2.5rem] rounded bg-gray-100 px-2 py-1 text-center text-sm font-semibold">J</span>
                                                <span class="text-sm">Oxid siřičitý a siřičitany</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 border-t border-gray-200 pt-4">
                                        <p class="text-left text-xs text-gray-600">
                                            Změna jídelního lístku a alergenů vyhrazena. Pokrm je určen k přímé spotřebě
                                        </p>
                                    </div>
                                </div>
                            </DialogContent>
                        </Dialog>
                        <Button
                            @click="$inertia.visit(`/jidelnicky/tisk?jidelna=${selectedEstablishment}`)"
                            variant="outline"
                            size="sm"
                            class="flex items-center gap-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                                />
                            </svg>
                            Vytisknout
                        </Button>
                    </div>
                </div>

                <!-- Menu Cards for each day -->
                <div class="space-y-6">
                    <Card v-for="menuDay in props.menuData" :key="menuDay.fullDate" :id="`menu-${menuDay.fullDate}`" class="scroll-mt-4">
                        <!-- Day Header -->
                        <CardHeader class="cursor-pointer gap-0" @click="handleDateSelect(menuDay.fullDate)">
                            <CardTitle class="text-lg font-semibold text-gray-900">
                                {{ menuDay.name }} {{ menuDay.date }}
                                <span
                                    v-if="menuDay.fullDate === new Date().toISOString().split('T')[0]"
                                    class="ml-2 rounded-full bg-yellow-100 px-2 text-sm text-yellow-700"
                                    >Dnes</span
                                >
                            </CardTitle>
                        </CardHeader>

                        <!-- Menu Content -->
                        <CardContent>
                            <MenuTable :menuData="[menuDay]" />
                        </CardContent>
                    </Card>
                </div>
            </div>

            <!-- No menu data message -->
            <div v-else-if="showMenu && selectedEstablishment" class="mt-8">
                <div class="rounded-lg bg-gray-50 p-8 text-center">
                    <p class="text-gray-600">Jídelníček není k dispozici. Jídelna nevaří nebo neposkytuje v tomto období informace o jídlech.</p>
                </div>
            </div>

            <div class="my-6">
                <p>Změna u jídelního lístku a alergenů vyhrazena. Pokrm je určen k přímé spotřebě.</p>
                <p>Strávnící mají denně k dispozici pitnou čistou vodu, mléko.</p>
            </div>
            <div class="flex flex-col space-y-4">
                <h4 class="mt-4 text-2xl font-bold text-brand-primary">Přihlášení do Strava.cz</h4>
                <p>
                    Pro objednávání a odhlašování obědů se přihlaste do systému Strava.cz. Po přihlášení můžete také sledovat aktuální jídelníček své
                    školní jídelny a spravovat údaje ke stravování.
                </p>
                <div>
                    <Button as="a" href="https://app.strava.cz/zalozit-ucet?jidelna" target="_blank" type="primary"> Strava.cz </Button>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>
