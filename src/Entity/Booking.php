<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     *
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThan(propertyPath="dateDebut")
     * message="La date de fin doit être plus éloignée que la date début !")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $prixtotale;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $iduser;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idvoiture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagevoiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPrixtotale(): ?string
    {
        return $this->prixtotale;
    }

    public function setPrixtotale(string $prixtotale): self
    {
        $this->prixtotale = $prixtotale;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(?int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdvoiture(): ?int
    {
        return $this->idvoiture;
    }

    public function setIdvoiture(?int $idvoiture): self
    {
        $this->idvoiture = $idvoiture;

        return $this;
    }

    public function getImagevoiture(): ?string
    {
        return $this->imagevoiture;
    }

    public function setImagevoiture(?string $imagevoiture): self
    {
        $this->imagevoiture = $imagevoiture;

        return $this;
    }




}
