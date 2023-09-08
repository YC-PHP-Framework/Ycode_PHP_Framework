<?php

namespace Yc\App\Entity;

use Yc\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Entity, ORM\Table(name: 'users')]
class User
{
    
    #[ORM\Id, ORM\Column(options: ['unsigned' => true]), ORM\GeneratedValue]
 
    private ?int $id;

    #[ORM\Column]
    private ?string $username;

    #[ORM\Column]
    private ?string $email;

    #[ORM\Column]
    private ?string $password;

    #[ORM\Column(name: "created_at")]
    private \DateTime $createdAt;

    #[ORM\Column(name: "updated_at")]
    private \DateTime $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }


    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
