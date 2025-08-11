<script setup>
const props = defineProps({
  dates: { type: Array, default: () => [] },
  selectedDate: { type: String, default: '' },
  helperText: { type: String, default: '' },
});

const emit = defineEmits(['select']);

const handleSelect = (dateString) => {
  emit('select', dateString);
};
</script>

<template>
  <div class="max-w-full overflow-x-auto">
    <div class="flex min-w-max items-center gap-1 pb-2">
      <template v-for="(date, index) in dates" :key="date.dateString">
        <div
          @click="handleSelect(date.dateString)"
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
          v-if="date.dayName === 'Ne' && index < dates.length - 1"
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
  <p v-if="helperText" class="mt-2 text-sm text-gray-500">{{ helperText }}</p>
</template>