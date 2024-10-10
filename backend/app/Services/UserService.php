<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class UserService
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function getAllUsers()
  {
    $user = $this->userRepository->getAll();

    if (!$user) {
      throw new \Exception('User registration failed.');
    }

    $token = JWTAuth::fromUser($user);

    return [
      'access_token' => $token,
      'token_type' => 'Bearer',
    ];
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
