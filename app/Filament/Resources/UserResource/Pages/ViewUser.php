<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }


    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['image'])) {
            $data['image'] = str_replace('storage/', '', $data['image']);
        }
        return $data;
    }
}
