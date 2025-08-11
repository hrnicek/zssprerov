<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $establishments = Establishment::all();
        $menuData = [];

        // Check if establishment code is provided
        if ($request->has('jidelna')) {
            $establishmentCode = $request->get('jidelna');
            $selectedDate = $request->get('datum', date('Y-m-d'));

            // Generate 3 weeks of dates based on selected date
            $selectedDates = $this->generateThreeWeekDates($selectedDate);

            try {
                // Fetch menu data from Strava.cz API
                $response = Http::timeout(10)->get('https://www.strava.cz/strava5/Jidelnicky/XML', [
                    'zarizeni' => $establishmentCode,
                ]);

                if ($response->successful()) {
                    $menuData = $this->parseMenuXml($response->body(), $selectedDates);
                }
            } catch (\Exception $e) {
                Log::error('Failed to fetch menu data: '.$e->getMessage());
            }
        }

        return inertia('menus/Index', [
            'establishments' => $establishments,
            'menuData' => $menuData,
            'selectedEstablishment' => $request->get('jidelna'),
            'selectedDates' => $request->get('dates', []),
        ]);
    }

    private function parseMenuXml(string $xmlContent, array $selectedDates = []): array
    {
        $menuData = [];

        try {
            $xml = simplexml_load_string($xmlContent);

            if ($xml === false) {
                return [];
            }

            // If no specific dates provided, generate 3 weeks from today
            if (empty($selectedDates)) {
                $selectedDates = $this->generateThreeWeekDates();
            }

            $dayNames = [
                1 => 'Pondělí',
                2 => 'Úterý',
                3 => 'Středa',
                4 => 'Čtvrtek',
                5 => 'Pátek',
            ];

            foreach ($xml->den as $day) {
                $datum = (string) $day['datum'];
                $date = \DateTime::createFromFormat('d-m-Y', $datum);

                if (! $date) {
                    continue;
                }

                // Check if this date is within the selected dates
                $dateString = $date->format('Y-m-d');
                if (! in_array($dateString, $selectedDates)) {
                    continue;
                }

                $dayOfWeek = (int) $date->format('N');

                // Skip weekends
                if ($dayOfWeek > 5) {
                    continue;
                }

                $dayData = [
                    'name' => $dayNames[$dayOfWeek] ?? 'Neznámý den',
                    'date' => $date->format('j. n.'),
                    'fullDate' => $dateString,
                    'dayOfWeek' => $dayOfWeek,
                    'meals' => [],
                ];

                foreach ($day->jidlo as $meal) {
                    $mealType = trim((string) $meal['druh']);
                    $mealName = trim((string) $meal['nazev']);
                    $allergens = trim((string) $meal['alergeny']);

                    // Skip empty meals
                    if (empty($mealName) || $mealName === $mealType) {
                        continue;
                    }

                    // Clean up allergen formatting
                    $allergens = $this->formatAllergens($allergens);

                    $dayData['meals'][] = [
                        'type' => $mealType,
                        'menu' => $mealName,
                        'allergens' => $allergens,
                    ];
                }

                if (! empty($dayData['meals'])) {
                    $menuData[] = $dayData;
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to parse menu XML: '.$e->getMessage());
        }

        return $menuData;
    }

    private function generateThreeWeekDates(): array
    {
        $dates = [];
        $startDate = new \DateTime;

        try {
            // Generate 21 days (3 weeks) starting from today
            for ($i = 0; $i < 21; $i++) {
                $currentDate = clone $startDate;
                $currentDate->add(new \DateInterval("P{$i}D"));

                // Only include weekdays (Monday to Friday)
                $dayOfWeek = (int) $currentDate->format('N');
                if ($dayOfWeek <= 5) {
                    $dates[] = $currentDate->format('Y-m-d');
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to generate three week dates: '.$e->getMessage());

            return [];
        }

        return $dates;
    }

    private function formatAllergens(string $allergens): string
    {
        if (empty($allergens) || $allergens === '-----') {
            return '';
        }

        // Remove common prefixes and clean up formatting
        $allergens = preg_replace('/^-----,/', '', $allergens);
        $allergens = preg_replace('/,-----.*$/', '', $allergens);
        $allergens = preg_replace('/Receptury,-----,.*?-----,/', '', $allergens);
        $allergens = preg_replace('/\s*-\s*/', ' ', $allergens);
        $allergens = preg_replace('/\s+/', ' ', $allergens);

        // Extract just the allergen numbers/codes
        preg_match_all('/\b\d+[a-z]?\b/', $allergens, $matches);

        if (! empty($matches[0])) {
            return implode(', ', array_unique($matches[0]));
        }

        return trim($allergens);
    }
}
