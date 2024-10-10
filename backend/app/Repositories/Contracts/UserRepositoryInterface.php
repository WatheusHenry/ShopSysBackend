<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
  public function createUser(array $data);

  public function findUserByEmail(string $email);

  public function findUserById(string $id);

  public function getAll();

}
