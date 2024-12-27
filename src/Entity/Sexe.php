<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SexeRepository;

#[ORM\Entity(repositoryClass: SexeRepository::class)]
class Sexe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
