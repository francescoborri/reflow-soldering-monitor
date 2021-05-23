<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=MeasurementRepository::class)
 * @ApiResource(
 *      attributes={
 *          "security"="is_granted('ROLE_USER')"
 *      },
 *      collectionOperations={
 *          "get",
 *          "post"={"security_post_denormalize"="object.getReflowSolderingOven().getManager() == user", "security_post_denormalize_message"="Access denied."}
 *     },
 * )
 */
class Measurement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", unique=true)
     */
    private $datetime;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $temperature;

    /**
     * @ORM\ManyToOne(targetEntity=ReflowSolderingOven::class, inversedBy="measurements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reflowSolderingOven;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getReflowSolderingOven(): ?ReflowSolderingOven
    {
        return $this->reflowSolderingOven;
    }

    public function setReflowSolderingOven(?ReflowSolderingOven $reflowSolderingOven): self
    {
        $this->reflowSolderingOven = $reflowSolderingOven;

        return $this;
    }
}
