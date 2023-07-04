<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate($resource, array $data): Model
    {
        $user = Parent::handleRecordUpdate($resource, $data);

        if ($data['email_verified_at']) {
            $user->email_verified_at = $data['email_verified_at'];
            $user->save();
        }

        return $user;
    }
}
