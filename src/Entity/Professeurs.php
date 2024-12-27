<?php

namespace App\Entity;

use App\Entity\Contrat;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfesseursRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProfesseursRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il y a déjà un compte avec cet e-mail')]
class Professeurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $LieuNaissance = null;

    #[ORM\Column(length: 1)]
    private ?string $Sexe = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $DateEnregistrement = null;

    #[ORM\OneToMany(mappedBy: 'Prenom', targetEntity: EmploiTemps::class, orphanRemoval: true)]
    private Collection $emploiTemps;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'professeurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contrat $Contrat = null;

    #[ORM\Column(length: 255)]
    private ?string $Profession = null;

    #[ORM\Column(length: 255)]
    private ?string $Nationalite = null;

    #[ORM\Column(length: 255)]
    private ?string $Diplome = null;

    #[ORM\Column]
    private ?float $Salaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DebutContrat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $FinContrat = null;

    #[ORM\OneToMany(mappedBy: 'Enseignant', targetEntity: Cours::class, orphanRemoval: true)]
    private Collection $cours;

    #[ORM\Column]
    private ?int $Telephone = null;

    #[ORM\OneToMany(mappedBy: 'Professeurs', targetEntity: Emargement::class)]
    private Collection $emargements;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    public function __construct()
    {
        $this->DateEnregistrement = new \DateTimeImmutable();
        $this->emploiTemps = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->emargements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): static
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->LieuNaissance;
    }

    public function setLieuNaissance(string $LieuNaissance): static
    {
        $this->LieuNaissance = $LieuNaissance;

        return $this;
    }
    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): static
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeImmutable
    {
        return $this->DateEnregistrement;
    }

    public function setDateEnregistrement(\DateTimeImmutable $DateEnregistrement): static
    {
        $this->DateEnregistrement = $DateEnregistrement;

        return $this;
    }
    /**
     * @return Collection<int, EmploiTemps>
     */
    public function getEmploiTemps(): Collection
    {
        return $this->emploiTemps;
    }

    public function addEmploiTemp(EmploiTemps $emploiTemp): static
    {
        if (!$this->emploiTemps->contains($emploiTemp)) {
            $this->emploiTemps->add($emploiTemp);
            $emploiTemp->setPrenom($this);
        }

        return $this;
    }

    public function removeEmploiTemp(EmploiTemps $emploiTemp): static
    {
        if ($this->emploiTemps->removeElement($emploiTemp)) {
            // set the owning side to null (unless already changed)
            if ($emploiTemp->getPrenom() === $this) {
                $emploiTemp->setPrenom(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->Contrat;
    }

    public function setContrat(?Contrat $Contrat): static
    {
        $this->Contrat = $Contrat;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->Profession;
    }

    public function setProfession(string $Profession): static
    {
        $this->Profession = $Profession;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->Nationalite;
    }

    public function setNationalite(string $Nationalite): static
    {
        $this->Nationalite = $Nationalite;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->Diplome;
    }

    public function setDiplome(string $Diplome): static
    {
        $this->Diplome = $Diplome;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->Salaire;
    }

    public function setSalaire(float $Salaire): static
    {
        $this->Salaire = $Salaire;

        return $this;
    }

    public function getDebutContrat(): ?\DateTimeInterface
    {
        return $this->DebutContrat;
    }

    public function setDebutContrat(\DateTimeInterface $DebutContrat): static
    {
        $this->DebutContrat = $DebutContrat;

        return $this;
    }

    public function getFinContrat(): ?\DateTimeInterface
    {
        return $this->FinContrat;
    }

    public function setFinContrat(?\DateTimeInterface $FinContrat): static
    {
        $this->FinContrat = $FinContrat;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setEnseignant($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getEnseignant() === $this) {
                $cour->setEnseignant(null);
            }
        }

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    /**
     * @return Collection<int, Emargement>
     */
    public function getEmargements(): Collection
    {
        return $this->emargements;
    }

    public function addEmargement(Emargement $emargement): static
    {
        if (!$this->emargements->contains($emargement)) {
            $this->emargements->add($emargement);
            $emargement->setProfesseurs($this);
        }

        return $this;
    }

    public function removeEmargement(Emargement $emargement): static
    {
        if ($this->emargements->removeElement($emargement)) {
            // set the owning side to null (unless already changed)
            if ($emargement->getProfesseurs() === $this) {
                $emargement->setProfesseurs(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }
}
