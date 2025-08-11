<script setup>
import Section from '@/components/Section.vue';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
</script>
<template>
    <Section title="Strávníci" class="py-16">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div>
                <Card>
                    <CardHeader>
                        <CardTitle class="text-brand-primary"> Senioři a veřejnost </CardTitle>
                        <CardDescription class="h-12">
                            Nabízíme chutná a vyvážená jídla každý den, včetně dietních variant jako je diabetická, šetřící nebo žlučníková.
                            Zajišťujeme rozvoz až domů a teplé obědy dodáváme i o víkendech a svátcích.
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="p-4">
                        <Button class="mt-4"> Přihlásit se ke stravování </Button>
                        <div class="mt-12">
                            <img src="/img/piktogram-seniori-verejnost.svg" alt="piktogram" class="float-right" />
                        </div>
                    </CardContent>
                </Card>
            </div>
            <div>
                <Card>
                    <CardHeader>
                        <CardTitle class="text-brand-primary"> Žáci a studenti </CardTitle>
                        <CardDescription class="h-12">
                            Obědy pro děti v MŠ, ZŠ a SŠ – vyvážené porce, pestrý jídelníček a možnost dietního stravování. Přihlášení, čipy i
                            odhlášky řešíte jednoduše online.
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="p-4">
                        <Button class="mt-4">Strava.cz</Button>
                        <div class="mt-12">
                            <img src="/img/piktogram-studenti.svg" alt="piktogram" class="float-right" />
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
        <div class="mt-8">
            <p>
                Zajišťujeme každodenní stravování pro děti, žáky, studenty, zaměstnance i seniory. Každý den připravujeme čerstvá, chutná a nutričně
                vyvážená jídla v souladu s věkovými potřebami i specifickými dietními požadavky. Nabízíme pohodlné objednávání, přehledný výdej i
                individuální přístup ke každé skupině strávníků.
            </p>
            <div class="mt-8">
                <Button> Více </Button>
            </div>
        </div>
    </Section>
</template>
