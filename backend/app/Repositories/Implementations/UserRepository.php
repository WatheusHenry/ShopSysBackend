<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
  public function createUser(array $data)
  {
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);
  }

  public function findUserByEmail(string $email)
  {
    return User::where('email', $email)->first();
  }

  public function findUserById(string $id)
  {
    return User::where('id', $id)->first();
  }
}
