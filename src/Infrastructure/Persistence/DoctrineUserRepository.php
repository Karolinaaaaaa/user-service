<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Model\User;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
  private EntityManagerInterface $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function save(User $user): void
  {
    $this->em->persist($user);
    $this->em->flush();
  }

  public function findAll(): array
  {
    return $this->em->getRepository(User::class)->findAll();
  }
}
