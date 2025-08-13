<?php

namespace App\Filament\Resources\Establishments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EstablishmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Název')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Kód')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Typ')
                    ->searchable(),
                TextColumn::make('address')
                    ->label('Adresa')
                    ->searchable(),
                TextColumn::make('city')
                    ->label('Město')
                    ->searchable(),
                TextColumn::make('postal_code')
                    ->label('PSČ')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mailová adresa')
                    ->searchable(),
                TextColumn::make('longitude')
                    ->label('Zeměpisná délka')
                    ->searchable(),
                TextColumn::make('latitude')
                    ->label('Zeměpisná šířka')
                    ->searchable(),
                TextColumn::make('order_column')
                    ->label('Pořadí')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Vytvořeno')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Aktualizováno')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
