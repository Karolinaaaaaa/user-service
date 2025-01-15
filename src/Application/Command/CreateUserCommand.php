<?php

namespace App\Application\Command;

class CreateUserCommand
{
  public function __construct(
    public string $name,
    public string $surname
  ) {}
}
