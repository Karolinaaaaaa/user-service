<?php

namespace App\Domain\Repository;

use App\Domain\Model\User;

interface UserRepositoryInterface
{
  public function save(User $user): void;
  public function findAll(): array;
}
