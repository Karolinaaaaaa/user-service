<?php

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "attachments")]
class Attachment
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: "integer")]
  private ?int $id = null;

  #[ORM\Column(type: "string", length: 255)]
  private string $fileName;

  #[ORM\Column(type: "string", length: 255)]
  private string $filePath;

  #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "attachments")]
  #[ORM\JoinColumn(nullable: false)]
  private User $user;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFileName(): string
  {
    return $this->fileName;
  }

  public function setFileName(string $fileName): void
  {
    $this->fileName = $fileName;
  }

  public function getFilePath(): string
  {
    return $this->filePath;
  }

  public function setFilePath(string $filePath): void
  {
    $this->filePath = $filePath;
  }

  public function getUser(): User
  {
    return $this->user;
  }

  public function setUser(User $user): void
  {
    $this->user = $user;
  }
}
