<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Jméno')
                        ->required(),
                    TextInput::make('position')
                        ->label('Pozice')
                        ->required(),
                    TextInput::make('order_column')
                        ->label('Pořadí')
                        ->numeric(),
                    TextInput::make('email')
                        ->label('E-mailová adresa')
                        ->email(),
                    TextInput::make('phone')
                        ->label('Telefon')
                        ->tel(),
                ]),
            ]);
    }
}
