<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Module;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = bcrypt($data['password']);

        return $data;
    }

    protected function afterCreate(): void
    {

        if ($this->record->hasRole('user')) {
            $modules = Module::get()->pluck('id');

            // assign all modules to the new created user
            $this->record->modules()->sync($modules);
        }
    }
}
