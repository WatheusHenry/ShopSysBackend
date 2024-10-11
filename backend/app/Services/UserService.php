<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserService
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function getAllUsers()
  {
    $users = $this->userRepository->getAll();

    if (!$users) {
      throw new \Exception('Users not found');
    }

    // $token = JWTAuth::fromUser($user);

    return [
      'usuarios' => $users,
      // 'access_token' => $token,
      // 'token_type' => 'Bearer',
    ];
  }

  public function findUserById(string $id)
  {
    return $this->userRepository->findUserById($id);
  }

  public function updateUser(string $id, array $data)
  {
    $user = $this->userRepository->findUserById($id);
    if (!$user) {
      throw new \Exception('User not found.');
    }

    if (isset($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    }

    $user->update($data);
    return $user;
  }

  public function deleteUser(string $id)
  {
    $user = $this->userRepository->findUserById($id);
    if (!$user) {
      throw new \Exception('User not found.');
    }
    return $user->delete();
  }

  public function login(array $credentials)
  {
    if (!$token = Auth::attempt($credentials)) {
      throw new \Exception('Unauthorized');
    }

    return [
      'access_token' => $token,
      'token_type' => 'Bearer',
    ];
  }
}
