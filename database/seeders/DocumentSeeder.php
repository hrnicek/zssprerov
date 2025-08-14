<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filesPath = public_path('files');

        if (! File::exists($filesPath)) {
            $this->command->info('Files directory does not exist at: '.$filesPath);

            return;
        }

        $files = File::files($filesPath);
        $order = 1;

        foreach ($files as $file) {
            $fileName = $file->getFilename();
            $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);

            // Create document record
            $document = Document::create([
                'name' => $fileNameWithoutExtension,
                'order_column' => $order,
                'is_visible' => true,
                'on_home' => false,
            ]);
            // Add file to media collection
            $document->addMedia($file->getPathname())
                ->preservingOriginal()
                ->toMediaCollection('documents');

            $this->command->info('Created document: '.$fileNameWithoutExtension);
            $order++;
        }

        $this->command->info('DocumentSeeder completed successfully!');
    }
}
