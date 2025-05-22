<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/projets/{id}',
            normalizationContext: ['groups' => ['read:collection', 'read:item']],
        ),
        new GetCollection(
            uriTemplate: '/projets',
            normalizationContext: ['groups' => ['read:collection']],
        ),
        new Post(
            uriTemplate: '/projets',
            denormalizationContext: ['groups' => ['write']],
        ),
        new Patch(
            uriTemplate: '/projets/{id}',
            denormalizationContext: ['groups' => ['write']],
        ),
        new Delete(
            uriTemplate: '/projets/{id}',
        )

    ],
    security: "is_granted('ROLE_ADMIN')",
)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collection', 'write'])]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:collection', 'write'])]
    private ?string $descriptionCourte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['write'])]
    private ?string $descriptionLongue = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['write'])]
    private ?string $lienGithub = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['write'])]
    private ?string $lienSiteWeb = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    #[Groups(['read:collection', 'write'])]
    private ?\DateTimeImmutable $dateRealisation = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['read:collection', 'write'])]
    private ?bool $favori = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'projets')]
    #[Groups(['read:collection', 'write'])]
    private Collection $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }


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

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }

}
