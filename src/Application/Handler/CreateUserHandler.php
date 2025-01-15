<?php

namespace App\Application\Handler;

use App\Application\Command\CreateUserCommand;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepositoryInterface;

class CreateUserHandler
{
  private UserRepositoryInterface $repository;

  public function __construct(UserRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function handle(CreateUserCommand $command): void
  {
    $user = new User($command->name, $command->surname);
    $this->repository->save($user);
  }
}
