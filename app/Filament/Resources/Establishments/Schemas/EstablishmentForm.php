<?php

namespace App\Filament\Resources\Establishments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EstablishmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Název')
                        ->required(),
                    TextInput::make('code')
                        ->label('Kód')
                        ->required()
                        ->numeric(),
                    TextInput::make('type')
                        ->label('Typ')
                        ->required()
                        ->default('zs'),
                    TextInput::make('address')
                        ->label('Adresa'),
                    TextInput::make('city')
                        ->label('Město'),
                    TextInput::make('postal_code')
                        ->label('PSČ'),
                    TextInput::make('phone')
                        ->label('Telefon')
                        ->tel(),
                    TextInput::make('email')
                        ->label('E-mailová adresa')
                        ->email(),
                    TextInput::make('longitude')
                        ->label('Zeměpisná délka'),
                    TextInput::make('latitude')
                        ->label('Zeměpisná šířka'),
                    TextInput::make('order_column')
                        ->label('Pořadí')
                        ->numeric(),
                ])->columnSpanFull(),
            ]);
    }
}
