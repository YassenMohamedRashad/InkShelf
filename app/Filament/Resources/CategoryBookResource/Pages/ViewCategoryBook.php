<?php

namespace App\Filament\Resources\CategoryBookResource\Pages;

use App\Filament\Resources\CategoryBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoryBook extends ViewRecord
{
    protected static string $resource = CategoryBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
