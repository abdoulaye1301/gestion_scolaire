<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ElevesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ElevesRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il y a déjà un compte avec cet e-mail')]
class Eleves
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

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?DateTimeImmutable $DateEnregistrement = null;

    #[ORM\Column(length: 1)]
    private ?string $Sexe = null;

    #[ORM\OneToMany(mappedBy: 'Eleve', targetEntity: Inscription::class, orphanRemoval: true)]
    private Collection $inscriptions;

    #[ORM\OneToMany(mappedBy: 'email', targetEntity: Devoir::class, orphanRemoval: true)]
    private Collection $devoirs;

    #[ORM\OneToMany(mappedBy: 'email', targetEntity: Composition::class, orphanRemoval: true)]
    private Collection $compositions;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parents $TelephoneParent = null;

    #[ORM\Column(nullable: true)]
    private ?int $Telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomPere = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomMere = null;

    #[ORM\Column(length: 255)]
    private ?string $NomMere = null;

    #[ORM\Column(length: 255)]
    private ?string $NomTuteur = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomTuteur = null;

    #[ORM\Column(nullable: true)]
    private ?int $TelephoneTuteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFileName = null;

    public function __construct()
    {
        $this->DateEnregistrement = new \DateTimeImmutable();
        $this->inscriptions = new ArrayCollection();
        $this->devoirs = new ArrayCollection();
        $this->compositions = new ArrayCollection();
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

    public function getDateEnregistrement(): ?\DateTimeImmutable
    {
        return $this->DateEnregistrement;
    }

    public function setDateEnregistrement(\DateTimeImmutable $DateEnregistrement): static
    {
        $this->DateEnregistrement = $DateEnregistrement;

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

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setEleve($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEleve() === $this) {
                $inscription->setEleve(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, Devoir>
     */
    public function getDevoirs(): Collection
    {
        return $this->devoirs;
    }

    public function addDevoir(Devoir $devoir): static
    {
        if (!$this->devoirs->contains($devoir)) {
            $this->devoirs->add($devoir);
            $devoir->setEmail($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getEmail() === $this) {
                $devoir->setEmail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Composition>
     */
    public function getCompositions(): Collection
    {
        return $this->compositions;
    }

    public function addComposition(Composition $composition): static
    {
        if (!$this->compositions->contains($composition)) {
            $this->compositions->add($composition);
            $composition->setEmail($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): static
    {
        if ($this->compositions->removeElement($composition)) {
            // set the owning side to null (unless already changed)
            if ($composition->getEmail() === $this) {
                $composition->setEmail(null);
            }
        }

        return $this;
    }

    public function getTelephoneParent(): ?Parents
    {
        return $this->TelephoneParent;
    }

    public function setTelephoneParent(?Parents $TelephoneParent): static
    {
        $this->TelephoneParent = $TelephoneParent;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(?int $Telephone): static
    {
        $this->Telephone = $Telephone;

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

    public function getPrenomPere(): ?string
    {
        return $this->PrenomPere;
    }

    public function setPrenomPere(string $PrenomPere): static
    {
        $this->PrenomPere = $PrenomPere;

        return $this;
    }

    public function getPrenomMere(): ?string
    {
        return $this->PrenomMere;
    }

    public function setPrenomMere(string $PrenomMere): static
    {
        $this->PrenomMere = $PrenomMere;

        return $this;
    }

    public function getNomMere(): ?string
    {
        return $this->NomMere;
    }

    public function setNomMere(string $NomMere): static
    {
        $this->NomMere = $NomMere;

        return $this;
    }

    public function getNomTuteur(): ?string
    {
        return $this->NomTuteur;
    }

    public function setNomTuteur(string $NomTuteur): static
    {
        $this->NomTuteur = $NomTuteur;

        return $this;
    }

    public function getPrenomTuteur(): ?string
    {
        return $this->PrenomTuteur;
    }

    public function setPrenomTuteur(string $PrenomTuteur): static
    {
        $this->PrenomTuteur = $PrenomTuteur;

        return $this;
    }

    public function getTelephoneTuteur(): ?int
    {
        return $this->TelephoneTuteur;
    }

    public function setTelephoneTuteur(int $TelephoneTuteur): static
    {
        $this->TelephoneTuteur = $TelephoneTuteur;

        return $this;
    }

    public function getImageFileName(): ?string
    {
        return $this->imageFileName;
    }

    public function setImageFileName(?string $imageFileName): static
    {
        $this->imageFileName = $imageFileName;

        return $this;
    }
}
