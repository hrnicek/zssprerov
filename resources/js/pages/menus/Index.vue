<script setup>
import AppContent from '@/components/AppContent.vue';
import MenuTable from '@/components/MenuTable.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref } from 'vue';

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

// Generate 3 weeks of calendar dates (all days) with week separators and month names
const generateCalendarDates = () => {
    const today = new Date();
    const weeks = [];
    const dayNames = ['Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne'];
    const monthNames = ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'];

    // Generate 21 calendar days (3 weeks)
    let currentDate = new Date(today);
    let addedDays = 0;
    let totalDays = 0;
    let currentWeek = [];
    let lastMonth = null;

    while (addedDays < 21 && totalDays < 30) {
        // Max 21 days (3 weeks), safety limit of 30 total days
        const dayOfWeek = currentDate.getDay();
        const currentMonth = currentDate.getMonth();
        const isNewMonth = lastMonth !== null && lastMonth !== currentMonth;

        // Include all days Monday (1) to Sunday (0)
        let adjustedDayOfWeek;
        if (dayOfWeek === 0) {
            // Sunday
            adjustedDayOfWeek = 6;
        } else {
            adjustedDayOfWeek = dayOfWeek - 1; // Convert Monday (1) to 0, etc.
        }

        const dateObj = {
            date: new Date(currentDate),
            dayName: dayNames[adjustedDayOfWeek],
            day: currentDate.getDate(),
            month: currentDate.getMonth() + 1,
            year: currentDate.getFullYear(),
            isToday: currentDate.toDateString() === today.toDateString(),
            dateString: currentDate.toISOString().split('T')[0],
            isNewMonth: isNewMonth,
            monthName: monthNames[currentMonth],
        };

        if (dayOfWeek === 0) {
            // It's Sunday, check if next day is a new month
            const nextDay = new Date(currentDate);
            nextDay.setDate(currentDate.getDate() + 1);
            if (nextDay.getMonth() !== currentMonth) {
                dateObj.monthNameForSeparator = monthNames[nextDay.getMonth()];
            }
        }

        // Start new week on Monday (dayOfWeek === 1) or if current week is full
        if (dayOfWeek === 1 || currentWeek.length === 7) {
            if (currentWeek.length > 0) {
                weeks.push({ type: 'week', dates: currentWeek });
            }
            currentWeek = [dateObj];
        } else {
            currentWeek.push(dateObj);
        }

        lastMonth = currentMonth;
        addedDays++;

        currentDate.setDate(currentDate.getDate() + 1);
        totalDays++;
    }

    // Add the last week if it has dates
    if (currentWeek.length > 0) {
        weeks.push({ type: 'week', dates: currentWeek });
    }

    return weeks;
};

const calendarWeeks = generateCalendarDates();

// Flattened array of all dates for functions that need individual date access
const calendarDates = computed(() => {
    return calendarWeeks.flatMap((week) => week.dates);
});

const selectedEstablishment = ref(props.selectedEstablishment || '');
const selectedDate = ref('');
const selectedSchoolType = ref('materska');
const showMenu = ref(!!props.menuData && !!selectedEstablishment.value);
const isScrolling = ref(false);

// Scroll to date function
const scrollToDate = (dateString) => {
    const element = document.getElementById(`menu-${dateString}`);
    if (element) {
        // Add offset for sticky header
        const headerOffset = 100;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth',
        });
    }
};

// Handle date selection
const selectDate = (dateString) => {
    isScrolling.value = true;
    selectedDate.value = dateString;

    // Update URL hash with DD.MM.YYYY format
    const dateParts = dateString.split('-');
    if (dateParts.length === 3) {
        const [year, month, day] = dateParts;
        const hashDate = `${day}.${month}.${year}`;
        history.replaceState(null, '', `#${hashDate}`);
    }

    scrollToDate(dateString);

    // Reset scrolling flag after scroll completes
    setTimeout(() => {
        isScrolling.value = false;
    }, 1500);
};

// Fetch menu for establishment with selected date
const fetchMenuForEstablishment = () => {
    if (!selectedEstablishment.value) return;

    // Use selected date or today's date as fallback
    const dateToSend = selectedDate.value || new Date().toISOString().split('T')[0];

    router.visit('/jidelniky', {
        method: 'get',
        data: {
            jidelna: selectedEstablishment.value.toString(),
            datum: dateToSend,
        },
        except: ['establishment'],
        preserveState: true,
        preserveScroll: true,
    });
};

const establishmentOptions = computed(() => {
    return props.establishments.map((establishment) => ({
        value: establishment.code,
        label: establishment.name,
    }));
});

// Handle establishment selection
const handleEstablishmentChange = () => {
    if (selectedEstablishment.value) {
        fetchMenuForEstablishment();
    }
    showMenu.value = !!selectedEstablishment.value;
};

// Handle URL hash for direct date linking
const handleUrlHash = () => {
    const hash = window.location.hash.substring(1); // Remove # symbol
    if (hash) {
        // Convert DD.MM.YYYY to YYYY-MM-DD format
        const dateParts = hash.split('.');
        if (dateParts.length === 3) {
            const [day, month, year] = dateParts;
            const formattedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
            selectedDate.value = formattedDate;
            // Scroll to date after a short delay to ensure DOM is ready
            setTimeout(() => scrollToDate(formattedDate), 100);
        }
    }
};

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

// Scroll detection for auto-selecting dates
let scrollObserver = null;
let scrollTimeout = null;

const setupScrollDetection = () => {
    // Clean up existing observer
    if (scrollObserver) {
        scrollObserver.disconnect();
    }

    const menuSections = document.querySelectorAll('[id^="menu-"]');
    if (menuSections.length === 0) {
        // Retry after delay if sections not found
        setTimeout(setupScrollDetection, 1000);
        return;
    }

    scrollObserver = new IntersectionObserver(
        (entries) => {
            if (isScrolling.value) return;

            // Debounce the updates
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }

            scrollTimeout = setTimeout(() => {
                let mostVisible = null;
                let maxRatio = 0;

                entries.forEach((entry) => {
                    if (entry.isIntersecting && entry.intersectionRatio > maxRatio) {
                        maxRatio = entry.intersectionRatio;
                        mostVisible = entry.target;
                    }
                });

                if (mostVisible && maxRatio > 0.3) {
                    const dateString = mostVisible.id.replace('menu-', '');
                    if (selectedDate.value !== dateString) {
                        selectedDate.value = dateString;

                        // Update URL hash
                        const dateParts = dateString.split('-');
                        if (dateParts.length === 3) {
                            const [year, month, day] = dateParts;
                            const hashDate = `${day}.${month}.${year}`;
                            history.replaceState(null, '', `#${hashDate}`);
                        }
                    }
                }
            }, 100);
        },
        {
            threshold: [0, 0.1, 0.3, 0.5, 0.7, 1.0],
            rootMargin: '-100px 0px -100px 0px',
        },
    );

    menuSections.forEach((section) => {
        scrollObserver.observe(section);
    });

    return scrollObserver;
};

// Handle URL hash on component mount
onMounted(() => {
    handleUrlHash();
    // Listen for hash changes
    window.addEventListener('hashchange', handleUrlHash);

    // Setup scroll detection after a delay to ensure DOM is ready
    setTimeout(() => {
        setupScrollDetection();
    }, 500);
});

// Cleanup on component unmount
onUnmounted(() => {
    if (scrollObserver) {
        scrollObserver.disconnect();
        scrollObserver = null;
    }
    if (scrollTimeout) {
        clearTimeout(scrollTimeout);
        scrollTimeout = null;
    }
    window.removeEventListener('hashchange', handleUrlHash);
});
</script>
<template>
    <Head title="Jídelníčky"></Head>
    <AppLayout>
        <AppContent class="max-w-none px-0">
            <div class="px-6 mb-3">
                <h3 class="text-2xl font-bold text-brand-primary">Jídelníčky</h3>
            </div>
            <Card class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm p-4 overflow-hidden rounded-none">
                <CardHeader class="pb-3">
                    <p class="mb-4 text-gray-600">Zvolte pobočku a klikněte na datum pro zobrazení jídelníčku.</p>

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <!-- Left side: Establishment Select and School Type Buttons -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="min-w-[200px]">
                                <Select
                                    v-model="selectedEstablishment"
                                    :options="establishmentOptions"
                                    placeholder="Vyberte jídelnu"
                                    @update:modelValue="handleEstablishmentChange"
                                />
                            </div>

                            <!-- School Type Buttons -->
                            <div class="flex gap-2">
                                <Button
                                    type="button"
                                    @click="selectedSchoolType = 'materska'"
                                    :variant="selectedSchoolType === 'materska' ? 'default' : 'outline'"
                                    class="rounded-full text-xs px-3 py-1"
                                    size="sm"
                                >
                                    Mateřská škola
                                </Button>
                                <Button
                                    type="button"
                                    @click="selectedSchoolType = 'zakladni'"
                                    :variant="selectedSchoolType === 'zakladni' ? 'default' : 'outline'"
                                    class="rounded-full text-xs px-3 py-1"
                                    size="sm"
                                >
                                    Základní škola
                                </Button>
                            </div>
                        </div>

                        <!-- Right side: Date Selector -->
                        <div v-if="selectedEstablishment" class="flex-1 lg:max-w-2xl">
                    <div class="max-w-full overflow-x-auto">
                        <div class="flex min-w-max items-center gap-1 pb-2">
                            <template v-for="(date, index) in calendarDates" :key="date.dateString">
                                <div
                                    @click="selectDate(date.dateString)"
                                    class="relative flex h-14 w-14 flex-shrink-0 cursor-pointer flex-col items-center justify-center rounded-lg border transition-all hover:bg-brand-beige/50"
                                    :class="{
                                        'rounded-full border-transparent bg-brand-primary text-white hover:bg-brand-primary':
                                            selectedDate === date.dateString,
                                        'border-brand-primary/30 bg-brand-beige': date.isToday && selectedDate !== date.dateString,
                                        'border-brand-primary/20 hover:border-brand-primary/40': selectedDate !== date.dateString && !date.isToday,
                                    }"
                                >
                                    <div
                                        class="text-xs font-medium"
                                        :class="{
                                            'text-white': selectedDate === date.dateString,
                                            'text-brand-dark-blue': selectedDate !== date.dateString,
                                        }"
                                    >
                                        {{ date.dayName }}
                                    </div>
                                    <div
                                        class="text-lg font-bold"
                                        :class="{
                                            'text-white': selectedDate === date.dateString,
                                            'text-brand-dark-blue': selectedDate !== date.dateString,
                                        }"
                                    >
                                        {{ date.day }}
                                    </div>
                                    <!-- Month indicator -->
                                    <div v-if="date.isNewMonth" class="absolute -top-6 left-0 text-xs font-semibold text-brand-primary">
                                        {{ date.monthName }}
                                    </div>
                                </div>
                                <div
                                    v-if="date.dayName === 'Ne' && index < calendarDates.length - 1"
                                    class="relative mx-2 flex h-12 items-center border-l border-gray-300"
                                >
                                    <span
                                        v-if="date.monthNameForSeparator"
                                        class="ml-1 rotate-180 text-xs font-semibold text-brand-primary [writing-mode:vertical-rl]"
                                        >{{ date.monthNameForSeparator }}</span
                                    >
                                </div>
                            </template>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Klikněte na datum pro přechod na jídelníček daného dne</p>
                </div>
            </Card>

            <!-- Menu Display -->
            <div v-if="showMenu && props.menuData && props.menuData.length > 0" class="mt-8">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Jídelníček</h3>
                    <div class="flex gap-3">
                        <Button v-if="selectedDate" variant="outline" size="sm" @click="scrollToDate(selectedDate)" class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>
                            Přejít na datum
                        </Button>
                        <Button variant="outline" size="sm" class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                            Stáhnout PDF
                        </Button>
                        <Button variant="outline" size="sm" class="flex items-center gap-2">
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
                        <CardHeader class="cursor-pointer gap-0" @click="selectDate(menuDay.fullDate)">
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
