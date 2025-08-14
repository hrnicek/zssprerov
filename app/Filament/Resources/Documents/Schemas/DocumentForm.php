<?php

namespace App\Filament\Resources\Documents\Schemas;

use App\Models\Establishment;
use Filament\Forms\Components\Select;
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
                    Select::make('establishment_id')
                        ->label('ID zařízení')
                        ->options(Establishment::pluck('name', 'id')),

                    Toggle::make('is_visible')
                        ->label('Je viditelný')
                        ->required(),
                    Toggle::make('on_home')
                        ->label('Na domovské stránce')
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('avatar')
                        ->required()
                        ->collection('documents'),

                ]),

            ]);
    }
}
