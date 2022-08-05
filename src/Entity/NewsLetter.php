<?php

namespace App\Entity;

use App\Repository\NewsLetterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsLetterRepository::class)
 */
class NewsLetter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_complet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_abonnement;

    /**
     * @ORM\Column(type="bigint")
     */
    private $mails_recu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nom_complet;
    }

    public function setNomComplet(?string $nom_complet): self
    {
        $this->nom_complet = $nom_complet;

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

    public function getDateAbonnement(): ?\DateTimeInterface
    {
        return $this->date_abonnement;
    }

    public function setDateAbonnement(\DateTimeInterface $date_abonnement): self
    {
        $this->date_abonnement = $date_abonnement;

        return $this;
    }

    public function getMailsRecu(): ?string
    {
        return $this->mails_recu;
    }

    public function setMailsRecu(string $mails_recu): self
    {
        $this->mails_recu = $mails_recu;

        return $this;
    }
}
