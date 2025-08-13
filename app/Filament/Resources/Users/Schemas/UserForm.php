<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Jméno')
                        ->required(),
                    TextInput::make('email')
                        ->label('E-mailová adresa')
                        ->email()
                        ->required(),
                    DateTimePicker::make('email_verified_at')
                        ->label('E-mail ověřen'),
                    TextInput::make('password')
                        ->label('Heslo')
                        ->password()
                        ->required(),
                ]),
            ]);
    }
}
