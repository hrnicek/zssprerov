<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Název')
                        ->required(),
                    TextInput::make('establishment_id')
                        ->label('ID zařízení')
                        ->numeric(),
                    Toggle::make('is_visible')
                        ->label('Je viditelný')
                        ->required(),
                    Toggle::make('on_home')
                        ->label('Na domovské stránce')
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('file')
                        ->label('Soubor')
                        ->required()
                        ->disk('public')
                        ->directory('documents')
                        ->collection('document'),
                ]),

            ]);
    }
}
