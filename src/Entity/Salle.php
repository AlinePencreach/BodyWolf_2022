<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
    normalizationContext: ['groups' => ['read'], "enable_max_depth" => true],
)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read'])]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'salles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Structure $structure = null;

    #[ORM\Column]
    #[Groups(['read'])]
    private ?bool $is_active = null;

    #[ORM\ManyToMany(targetEntity: Permission::class, inversedBy: 'salle')]
    private Collection $permissions;

    #[ORM\OneToOne(inversedBy: 'salle', cascade: ['persist', 'remove'])]
    private ?User $manager = null;

    // #[ORM\ManyToMany(targetEntity: Permission::class, mappedBy: 'salle')]
    // private Collection $permissions;

    public function __construct()
    {
        // $this->manager = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    // /**
    //  * @return Collection<int, User>
    //  */
    // public function getManager(): Collection
    // {
    //     return $this->manager;
    // }

    // public function addManager(User $manager): self
    // {
    //     if (!$this->manager->contains($manager)) {
    //         $this->manager->add($manager);
    //         $manager->setSalle($this);
    //     }

    //     return $this;
    // }

    // public function removeManager(User $manager): self
    // {
    //     if ($this->manager->removeElement($manager)) {
    //         // set the owning side to null (unless already changed)
    //         if ($manager->getSalle() === $this) {
    //             $manager->setSalle(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }


    /**
     * @return Collection<int, Permission>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
            $permission->addSalle($this);
        }

        return $this;
    }

    public function removePermission(Permission $permission): self
    {
        if ($this->permissions->removeElement($permission)) {
            $permission->removeSalle($this);
        }

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }
}
