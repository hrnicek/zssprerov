<?php

namespace App\Filament\Resources\CanteenResource\Pages;

use App\Filament\Resources\CanteenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCanteen extends EditRecord
{
    protected static string $resource = CanteenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
