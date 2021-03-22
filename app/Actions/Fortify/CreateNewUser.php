<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'code_client' => ['required', 'int', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'code_client' => $input['code_client'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
