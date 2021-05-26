<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StaffRepository::class)
 * @ApiResource(
 *      attributes={"security"="is_granted('ROLE_USER')"},
 *      collectionOperations={
 *          "get"={"normalization_context"={"groups"={"staff:collection:get"}}}
 *      },
 *      itemOperations={
 *          "get"={"normalization_context"={"groups"={"staff:item:get"}}}
 *      }
 * )
 */
class Staff implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=16)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $fiscalCode;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $phone;

    /**
     * @ORM\Column(type="date")
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=5)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $position;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $salary;

    /**
     * @ORM\ManyToOne(targetEntity=Office::class, inversedBy="staff")
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $office;

    /**
     * @ORM\ManyToOne(targetEntity=ProductionZone::class, inversedBy="staff")
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $productionZone;

    /**
     * @ORM\OneToMany(targetEntity=ReflowSolderingOven::class, mappedBy="manager")
     * @Groups({"staff:collection:get","staff:item:get"})
     */
    private $reflowSolderingOvens;

    public function __construct()
    {
        $this->reflowSolderingOvens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiscalCode(): ?string
    {
        return $this->fiscalCode;
    }

    public function setFiscalCode(string $fiscalCode): self
    {
        $this->fiscalCode = $fiscalCode;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->fiscalCode;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(?Office $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getProductionZone(): ?ProductionZone
    {
        return $this->productionZone;
    }

    public function setProductionZone(?ProductionZone $productionZone): self
    {
        $this->productionZone = $productionZone;

        return $this;
    }

    /**
     * @return Collection|ReflowSolderingOven[]
     */
    public function getReflowSolderingOvens(): Collection
    {
        return $this->reflowSolderingOvens;
    }

    public function addReflowSolderingOven(ReflowSolderingOven $reflowSolderingOven): self
    {
        if (!$this->reflowSolderingOvens->contains($reflowSolderingOven)) {
            $this->reflowSolderingOvens[] = $reflowSolderingOven;
            $reflowSolderingOven->setManager($this);
        }

        return $this;
    }

    public function removeReflowSolderingOven(ReflowSolderingOven $reflowSolderingOven): self
    {
        if ($this->reflowSolderingOvens->removeElement($reflowSolderingOven)) {
            // set the owning side to null (unless already changed)
            if ($reflowSolderingOven->getManager() === $this) {
                $reflowSolderingOven->setManager(null);
            }
        }

        return $this;
    }
}
