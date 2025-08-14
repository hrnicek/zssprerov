<script setup>
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
        title: 'O nás',
    },
]);
</script>
<template>
    <Head title="O nás"></Head>
    <AppLayout>
        <AppContent :breadcrumbs="breadcrumbs">
            <div>
                <h1 class="mb-6 text-xl font-bold text-brand-primary lg:text-2xl">O nás</h1>
                <div>
                    <p>
                        Zařízení školního stravování Přerov, p. o., patří v regionu k nejvýznamnějším organizacím, poskytující stravovací služby. Je
                        tvořena sloučenými provozy školních jídelen Kratochvílova 30, Za Mlýnem 1, Želatovská 8, Trávník 27, U tenisu 4, Hranická 14.
                        Dále pak sdružuje i výdejny Velká Dlážka 5, Svisle 13, Boženy Němcové 16 a také vývařovnu Kozlovská 44. Tato příspěvková
                        organizace, zřízená Městem Přerov, dodává stravu i do všech místních mateřských školek, klientům Sociálních služeb města
                        Přerova a také široké veřejnosti. Veškeré stravovací služby pro cca 7 tisíc strávníků zajišťuje přibližně 85 zaměstnanců.
                    </p>
                </div>
            </div>
        </AppContent>
    </AppLayout>
</template>
