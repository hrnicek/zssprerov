<script setup>
import { computed } from 'vue';

const props = defineProps({
    menuData: {
        type: Array,
        default: () => [],
    },
});

// Use actual menu data or empty array if not available
const menuData = computed(() => props.menuData || []);

// Format day header like "Pondělí 11. 8. 2025"
const formatDayHeader = (dayName, date) => {
    // Parse the date and format it properly
    const dateObj = new Date(date);
    const day = dateObj.getDate();
    const month = dateObj.getMonth() + 1;
    const year = dateObj.getFullYear();

    return `${dayName} ${day}. ${month}. ${year}`;
};

// Group meals by category
const getMealCategories = (meals) => {
    const categories = {};

    meals.forEach((meal) => {
        const categoryName = meal.type.toUpperCase();
        if (!categories[categoryName]) {
            categories[categoryName] = [];
        }
        categories[categoryName].push(meal);
    });

    return Object.entries(categories).map(([name, meals]) => ({
        name,
        meals,
    }));
};
</script>

<template>
    <div>
        <!-- Meals by Category -->
        <div v-if="menuData && menuData.length > 0" class="lg:space-y-3">
            <template v-for="(day, dayIndex) in menuData" :key="dayIndex">
                <template v-for="category in getMealCategories(day.meals)" :key="category.name">
                    <div>
                        <!-- Category Header -->
                        <h5 class="mb-3 text-sm font-semibold tracking-wider uppercase">{{ category.name }}</h5>

                        <!-- Category Meals -->
                        <div class="space-y-2">
                            <div v-for="(meal, mealIndex) in category.meals" :key="mealIndex" class="border-l-4 border-brand-primary pl-4">
                                <div class="text-sm leading-relaxed text-gray-900">
                                    {{ meal.menu }}
                                    <span v-if="meal.allergens" class="ml-2 text-gray-500">({{ meal.allergens }})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </template>
        </div>

        <!-- No menu data message -->
        <div v-else class="py-8 text-center text-gray-500">
            <p>Pro tento den není k dispozici jídelníček.</p>
        </div>
    </div>
</template>
