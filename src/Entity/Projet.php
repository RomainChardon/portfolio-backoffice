<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProjetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[ApiResource(security: "is_granted('ROLE_ADMIN')")]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionCourte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionLongue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lienGithub = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lienSiteWeb = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $dateRealisation = null;

    #[ORM\Column(nullable: true)]
    private ?bool $favori = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescriptionCourte(): ?string
    {
        return $this->descriptionCourte;
    }

    public function setDescriptionCourte(?string $descriptionCourte): static
    {
        $this->descriptionCourte = $descriptionCourte;

        return $this;
    }

    public function getDescriptionLongue(): ?string
    {
        return $this->descriptionLongue;
    }

    public function setDescriptionLongue(?string $descriptionLongue): static
    {
        $this->descriptionLongue = $descriptionLongue;

        return $this;
    }

    public function getLienGithub(): ?string
    {
        return $this->lienGithub;
    }

    public function setLienGithub(?string $lienGithub): static
    {
        $this->lienGithub = $lienGithub;

        return $this;
    }

    public function getLienSiteWeb(): ?string
    {
        return $this->lienSiteWeb;
    }

    public function setLienSiteWeb(?string $lienSiteWeb): static
    {
        $this->lienSiteWeb = $lienSiteWeb;

        return $this;
    }

    public function getDateRealisation(): ?\DateTimeImmutable
    {
        return $this->dateRealisation;
    }

    public function setDateRealisation(?\DateTimeImmutable $dateRealisation): static
    {
        $this->dateRealisation = $dateRealisation;

        return $this;
    }

    public function isFavori(): ?bool
    {
        return $this->favori;
    }

    public function setFavori(?bool $favori): static
    {
        $this->favori = $favori;

        return $this;
    }
}
