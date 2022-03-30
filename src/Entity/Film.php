<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Table(name:"sb_film"),
ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire')]
    #[Assert\Length(max: 10)]
    private $nom;

    #[ORM\Column(type: 'integer', options: ["comment" => "année de sortie"])]
    #[Assert\Range(minMessage: "Le cinéma n'existais pas avant {{ min }}", maxMessage: '{{ value }} est trop loin dans le futur',
        min: 1850, max: 2050)]
    private $annee;

    #[ORM\Column(type:'boolean', options:["default" => true])]
    #[Assert\Type(type: 'bool', message: "{{ value }} n'est pas un type boolean")]
    private $enstock;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Critique::class)]
    #[Assert\Valid()]
    private $critiques;

    public function __construct()
    {
        $this->enstock = true;
        $this->quantite = null;
        $this->critiques = new ArrayCollection();
    }

    #[Assert\Callback()]
    public function verifStock(ExecutionContextInterface $context)
    {
        if($this->enstock !== true && $this->quantite > 0)
        {
            $context->buildViolation('Incoherence entre quantite et en stock')
                ->atPath('enstock')
                ->addViolation();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getEnstock(): ?bool
    {
        return $this->enstock;
    }

    public function setEnstock(bool $enstock): self
    {
        $this->enstock = $enstock;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Critique>
     */
    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function addCritique(Critique $critique): self
    {
        if (!$this->critiques->contains($critique)) {
            $this->critiques[] = $critique;
            $critique->setFilm($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): self
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getFilm() === $this) {
                $critique->setFilm(null);
            }
        }

        return $this;
    }
}
