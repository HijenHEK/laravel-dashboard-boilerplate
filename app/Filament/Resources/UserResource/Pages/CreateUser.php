<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = Parent::handleRecordCreation($data);

        if ($data['email_verified_at']) {
            $user->email_verified_at = $data['email_verified_at'];
            $user->save();
        }

        return $user;
    }
}
