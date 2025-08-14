<script setup>
import Button from '@/components/ui/button/Button.vue';
import Section from './Section.vue';
</script>
<template>
    <Section title="Kariéra" class="py-16">
        <div>
            <div class="mb-8">
                <p>
                    Baví vás práce s lidmi, jídlem a smysluplným provozem? Přidejte se k nám! Hledáme spolehlivé kuchaře, kuchařky, pomocný personál i
                    administrativní posily. Nabízíme stabilní zázemí, smysluplnou práci a přátelské prostředí.
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <Button as="a" href="/kariera"> Aktuální otevřené pozice </Button>
                <Button variant="outline" as="a" href="/kontakt"> Kontakty </Button>
            </div>
        </div>
    </Section>
</template>
