<?php

namespace Database\Factories;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'establishment_id' => Establishment::factory(),
            'order_column' => $this->faker->numberBetween(1, 100),
            'is_visible' => $this->faker->boolean(80), // 80% chance to be visible
            'on_home' => $this->faker->boolean(30), // 30% chance to be on home
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function ($document) {
            // Create a fake PDF file
            $fakeFile = UploadedFile::fake()->create(
                $this->faker->slug() . '.pdf',
                100, // size in KB
                'application/pdf'
            );

            // Add the file to the document collection
            $document->addMedia($fakeFile)
                ->toMediaCollection('document');
        });
    }

    /**
     * Create a document that is visible.
     */
    public function visible(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_visible' => true,
        ]);
    }

    /**
     * Create a document that appears on home page.
     */
    public function onHome(): static
    {
        return $this->state(fn (array $attributes) => [
            'on_home' => true,
        ]);
    }

    /**
     * Create a document with a specific establishment.
     */
    public function forEstablishment(Establishment $establishment): static
    {
        return $this->state(fn (array $attributes) => [
            'establishment_id' => $establishment->id,
        ]);
    }
}
