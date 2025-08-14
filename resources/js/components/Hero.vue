<script setup>
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';
import Button from './ui/button/Button.vue';
import { Card, CardContent, CardTitle } from './ui/card';
import CardHeader from './ui/card/CardHeader.vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const props = defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
});

// Sample news data (replace with actual data from your backend)
const newsItems = [
    {
        id: 1,
        badge: 'Aktuálně',
        title: 'Nově si můžete vybrat až ze tří jídel denně',
        link: '#',
    },
    {
        id: 2,
        badge: 'Oznámení',
        title: 'Zápis do prvních tříd proběhne 15. dubna',
        link: '#',
    },
    {
        id: 3,
        badge: 'Událost',
        title: 'Den otevřených dveří se blíží',
        link: '#',
    },
];

// Button text
const buttonText = 'Více';
</script>
<template>
    <div class="my-8">
        <div
            class="relative container mx-auto h-[500px] min-h-[500px] object-cover object-center"
            style="background-image: url('/img/hero-bg.jpg'); background-size: cover; background-position: center"
        >
            <div class="absolute right-[10%] -bottom-[25%]">
                <Swiper
                    :modules="[Autoplay, Pagination, Navigation]"
                    :slides-per-view="1"
                    :space-between="30"
                    :autoplay="{
                        delay: 5000,
                        disableOnInteraction: false,
                    }"
                    :pagination="false"
                    :navigation="false"
                    class="min-h-[300px] w-full max-w-[400px]"
                >
                    <SwiperSlide v-for="item in newsItems" :key="item.id">
                        <Card class="w-full px-4 backdrop-blur-sm">
                            <CardHeader class="pb-2">
                                <div class="bg-brand-brick inline-block rounded-sm px-2 py-1 text-xs font-medium text-white">{{ item.badge }}</div>
                                <CardTitle class="mt-2 text-xl font-bold text-brand-primary">{{ item.title }}</CardTitle>
                            </CardHeader>
                            <CardContent class="pt-2">
                                <Button variant="outline">{{ buttonText }}</Button>
                            </CardContent>
                        </Card>
                    </SwiperSlide>
                </Swiper>
            </div>
        </div>
    </div>
</template>

<style>
/* Custom Swiper styling */
.swiper-pagination-bullet-active {
    background-color: var(--brand-brick) !important;
}

.swiper-button-next,
.swiper-button-prev {
    color: var(--brand-brick) !important;
    transform: scale(0.7);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-weight: bold;
}

.swiper-pagination {
    bottom: -5px !important;
}

/* Card styling to match the image */
.card-news {
    border-radius: 8px;
    overflow: hidden;
}

/* Button styling */
.btn-more {
    border-radius: 999px;
    padding: 0.5rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
}
</style>
