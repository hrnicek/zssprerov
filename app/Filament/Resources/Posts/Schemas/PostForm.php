<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label('Titulek')
                        ->required(),
                    TextInput::make('slug')
                        ->label('URL slug')
                        ->required(),
                    TextInput::make('perex')
                        ->label('Perex'),
                    Textarea::make('content')
                        ->label('Obsah')
                        ->columnSpanFull(),
                    DateTimePicker::make('published_at')
                        ->label('Publikováno'),
                ]),
            ]);
    }
}
