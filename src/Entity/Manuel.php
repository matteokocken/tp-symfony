<?php

namespace App\Entity;

use App\Repository\ManuelRepository;
use Doctrine\ORM\Mapping as ORM;

#[  ORM\Table(name:"ts_manuel"),
    ORM\Entity(repositoryClass: ManuelRepository::class)]
class Manuel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\Column(type: 'text', nullable: true)]
    private $sommaire;

    #[ORM\OneToOne(targetEntity: Produit::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    public function __construct() {
        $this->sommaire = NULL;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getSommaire(): ?string
    {
        return $this->sommaire;
    }

    public function setSommaire(?string $sommaire): self
    {
        $this->sommaire = $sommaire;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
