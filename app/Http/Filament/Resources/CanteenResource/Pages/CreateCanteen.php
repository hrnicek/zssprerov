<?php

namespace App\Filament\Resources\CanteenResource\Pages;

use App\Filament\Resources\CanteenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCanteen extends CreateRecord
{
    protected static string $resource = CanteenResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
