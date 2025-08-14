<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $questions = [
            'Jak se registrovat ke stravování?',
            'Kde najdu jídelníček?',
            'Jak se odhlašuje strava?',
            'Jak dlouho dopředu musím odhlásit stravu?',
            'Jaké jsou způsoby platby?',
            'Mohu změnit dietní omezení?',
            'Jak fungují jídelní lístky pro různé věkové kategorie?',
            'Co když zmeškám termín výběru stravy?',
            'Je možné si stravu rozvézt domů?',
            'Jak dlouho trvá vyřízení registrace?',
        ];

        $answers = [
            'Registraci provedete přes náš online formulář na stránkách školní jídelny. Během registrace vyplníte osobní údaje a vyberete typ stravování.',
            'Jídelníček najdete v sekci "Jídelníček" na našich webových stránkách. Zobrazuje se na týden dopředu a obsahuje kompletní nabídku pondělí až pátek.',
            'Odhlášení stravy provedete přihlášením se do systému a kliknutím na "Odhlásit stravu" u daného dne. Odhlášení musí být provedeno nejpozději den předem.',
            'Odhlášení stravy musí být provedeno nejpozději do 14:00 hodiny předchozího pracovního dne. Po tomto termínu již není možné stravu odhlásit.',
            'Platbu můžete provést hotově v kanceláři školní jídelny, bankovním převodem nebo platební kartou online přes školní systém.',
            'Změnu dietního omezení nahlásíte vedoucí školní jídelny osobně nebo emailem. Dieta bude nastavena od následujícího měsíce.',
            'Jídelní lístky jsou přizpůsobeny věkovým kategoriím - od MŠ až po dospělé. Každá kategorie má přizpůsobené porce a složení pokrmů.',
            'Při zmeškání výběru zařídíme standardní výběr stravy dle aktuálního jídelníčku. Výjimečně lze výběr změnit den předem po dohodě.',
            'Rozvoz stravy domů není v současnosti nabízen. Strava se vydává pouze v prostorách školní jídelny během oficiálních výdejních hodin.',
            'Vyřízení registrace obvykle trvá 1-2 pracovní dny. Po schválení registrace obdržíte přihlašovací údaje emailem.',
        ];

        $randomIndex = $this->faker->numberBetween(0, count($questions) - 1);

        return [
            'question' => $questions[$randomIndex],
            'answer' => $answers[$randomIndex],
            'order_column' => $this->faker->numberBetween(1, 50),
            'is_open' => $this->faker->boolean(25), // 25% šance na otevřené
        ];
    }

    /**
     * Create FAQ that is opened by default.
     */
    public function opened(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_open' => true,
        ]);
    }

    /**
     * Create FAQ with specific order.
     */
    public function order(int $order): static
    {
        return $this->state(fn (array $attributes) => [
            'order_column' => $order,
        ]);
    }

    /**
     * Create FAQ with custom question and answer.
     */
    public function content(string $question, string $answer): static
    {
        return $this->state(fn (array $attributes) => [
            'question' => $question,
            'answer' => $answer,
        ]);
    }

    /**
     * Create FAQ for common questions.
     */
    public function commonQuestion(): static
    {
        return $this->state(fn (array $attributes) => [
            'question' => 'Jak se registrovat ke stravování?',
            'answer' => 'Registraci provedete přes náš online formulář na stránkách školní jídelny.',
            'order_column' => 1,
            'is_open' => true,
        ]);
    }
}
