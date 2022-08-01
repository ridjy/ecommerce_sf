<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_panier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPanier(): ?int
    {
        return $this->id_panier;
    }

    public function setIdPanier(int $id_panier): self
    {
        $this->id_panier = $id_panier;

        return $this;
    }

    public function getDatePanier(): ?\DateTimeInterface
    {
        return $this->date_panier;
    }

    public function setDatePanier(\DateTimeInterface $date_panier): self
    {
        $this->date_panier = $date_panier;

        return $this;
    }
}
