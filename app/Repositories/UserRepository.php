<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findMany()
    {
        return User::paginate(config('variables.paginate.value'));
    }

    public function findOneById(User $user)
    {
        return User::findOrFail($user->id);
    }

    public function findOneByEmail(string $email)
    {
        return User::with([
            'facebook_user',
            'user_business',
            'linkedin_user'
        ])->where('email', $email)->first();
    }

    public function create(object $payload)
    {
        $user = new User();
        $user->facebook_id = $payload->facebook_id;
        $user->first_name = $payload->first_name;
        $user->last_name = $payload->last_name;
        $user->email = $payload->email;
        $user->gender = $payload->gender;
        $user->birthday = $payload->birthday;
        $user->password = Hash::make($payload->password);
        $user->status = $payload->status;
        $user->profile_photo = $payload->profile_photo;
        $user->last_login = $payload->last_login;
        $user->save();

        return $user->fresh();
    }

    public function update(object $payload, User $user)
    {
        $user = User::findOrFail($user->id);
        $user->first_name = $payload->first_name;
        $user->last_name = $payload->last_name;
        $user->email = $payload->email;
        $user->gender = $payload->gender;
        $user->birthday = $payload->birthday;
        $user->save();

        return $user->fresh();
    }

    public function delete(User $user)
    {
        return User::findOrFail($user->id)->delete();
    }
}
