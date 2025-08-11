<template>
  <div class="relative">
    <button
      ref="trigger"
      @click="toggleDropdown"
      @blur="handleBlur"
      class="flex w-full items-center justify-between rounded-full border border-gray-300 bg-white px-4 py-3 text-left text-gray-700 shadow-sm transition-colors hover:border-gray-400 focus:border-brand-primary focus:outline-none focus:ring-2 focus:ring-brand-primary/20"
      :class="{
        'border-brand-primary': isOpen,
        'text-gray-400': !selectedOption && placeholder
      }"
    >
      <span class="truncate">
        {{ selectedOption ? selectedOption.label : placeholder }}
      </span>
      <svg
        class="ml-2 h-4 w-4 transition-transform"
        :class="{ 'rotate-180': isOpen }"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-y-1"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-1"
    >
      <div
        v-if="isOpen"
        class="absolute z-50 mt-1 w-full rounded-lg border border-gray-200 bg-white shadow-lg"
      >
        <div class="max-h-60 overflow-auto py-1">
          <button
            v-for="option in options"
            :key="option.value"
            @click="selectOption(option)"
            class="flex w-full items-center px-4 py-3 text-left text-gray-700 transition-colors hover:bg-gray-50"
            :class="{
              'bg-brand-primary/10 text-brand-primary': selectedOption?.value === option.value
            }"
          >
            <span class="truncate">{{ option.label }}</span>
            <svg
              v-if="selectedOption?.value === option.value"
              class="ml-auto h-4 w-4 text-brand-primary"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue';

interface SelectOption {
  value: string | number;
  label: string;
}

interface Props {
  options: SelectOption[];
  modelValue?: string | number;
  placeholder?: string;
}

interface Emits {
  (e: 'update:modelValue', value: string | number): void;
}

const props = withDefaults(defineProps<Props>(), {
  placeholder: 'Vyberte možnost'
});

const emit = defineEmits<Emits>();

const isOpen = ref(false);
const trigger = ref<HTMLButtonElement>();

const selectedOption = computed(() => {
  return props.options.find(option => option.value === props.modelValue);
});

const toggleDropdown = () => {
  isOpen.value = !isOpen.value;
};

const selectOption = (option: SelectOption) => {
  emit('update:modelValue', option.value);
  isOpen.value = false;
};

const handleBlur = (event: FocusEvent) => {
  // Close dropdown if focus moves outside the component
  setTimeout(() => {
    if (!trigger.value?.contains(event.relatedTarget as Node)) {
      isOpen.value = false;
    }
  }, 100);
};

const handleClickOutside = (event: MouseEvent) => {
  if (trigger.value && !trigger.value.contains(event.target as Node)) {
    isOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>