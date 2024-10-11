<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthService
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function register(array $data)
  {
    $user = $this->userRepository->createUser($data);

    if (!$user) {
      throw new \Exception('User registration failed.');
    }

    $token = JWTAuth::fromUser($user);

    return [
      'user_id' => $user->id,
      'access_token' => $token,
      'token_type' => 'Bearer',
    ];
  }

  public function login(array $credentials)
  {
    if (!$token = Auth::attempt($credentials)) {
      throw new \Exception('Unauthorized');
    }
    $user = Auth::user();

    return [
      'user_id' => $user->id,
      'access_token' => $token,
      'token_type' => 'Bearer',
    ];
  }
}
