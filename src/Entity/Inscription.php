<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\InscriptionRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
#[UniqueEntity(fields: ['Eleve'], message: 'Cet élève est déjà inscrit')]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnneeScolaire $Annee = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleves $Eleve = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $DateInscription = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $NomClasse = null;

    #[ORM\Column]
    private ?float $Montant = null;

    #[ORM\Column(length: 255)]
    private ?string $Statut = null;

    public function __construct()
    {
        $this->DateInscription = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?AnneeScolaire
    {
        return $this->Annee;
    }

    public function setAnnee(?AnneeScolaire $Annee): static
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getEleve(): ?Eleves
    {
        return $this->Eleve;
    }

    public function setEleve(?Eleves $Eleve): static
    {
        $this->Eleve = $Eleve;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeImmutable
    {
        return $this->DateInscription;
    }

    public function setDateInscription(\DateTimeImmutable $DateInscription): static
    {
        $this->DateInscription = $DateInscription;

        return $this;
    }

    public function getNomClasse(): ?Classe
    {
        return $this->NomClasse;
    }

    public function setNomClasse(?Classe $NomClasse): static
    {
        $this->NomClasse = $NomClasse;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(float $Montant): static
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }
}
