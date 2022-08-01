<?php

namespace App\Entity;

use App\Repository\CommandeEntityRepository;
use App\Entity\Panier;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Il y a un seul panier possible par commande
     * @ORM\OneToOne(targetEntity="App\Entity\Panier")
     * @ORM\JoinColumn(name="id_panier", referencedColumnName="id")
     */
    private $panier;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_paiement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type_paiement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse_livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function setIdCommande(int $id_cmommande): self
    {
        $this->id_cmommande = $id_commande;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(?\DateTimeInterface $date_paiement): self
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    public function getTypePaiement(): ?string
    {
        return $this->type_paiement;
    }

    public function setTypePaiement(?string $type_paiement): self
    {
        $this->type_paiement = $type_paiement;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(?string $adresse_livraison): self
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }
}
