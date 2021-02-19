<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatRepository::class)
 */
class Etat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $no_etat;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="etats_no_etat")
     */
    private $sorties;

    public function __construct()
    {
        $this->sorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->no_etat;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorties(Sortie $sorties): self
    {
        if (!$this->sorties->contains($sorties)) {
            $this->sorties[] = $sorties;
            $sorties->setEtatsNoEtat($this);
        }

        return $this;
    }

    public function removeSorties(Sortie $sorties): self
    {
        if ($this->sorties->removeElement($sorties)) {
            // set the owning side to null (unless already changed)
            if ($sorties->getEtatsNoEtat() === $this) {
                $sorties->setEtatsNoEtat(null);
            }
        }

        return $this;
    }
}
