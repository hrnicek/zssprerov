<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Otázka')
                    ->required()
                    ->maxLength(255),
                
                Textarea::make('answer')
                    ->label('Odpověď')
                    ->required()
                    ->rows(4),
                
                TextInput::make('order_column')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),
                
                Toggle::make('is_open')
                    ->label('Otevřeno ve výchozím stavu')
                    ->default(false),
            ]);
    }
}
