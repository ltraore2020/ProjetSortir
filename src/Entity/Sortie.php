<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Inscription;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $no_sortie;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_cloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_inscription_max;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description_infos;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $url_photo;

    /**
     * @ORM\ManyToOne(targetEntity=Participant::class, inversedBy="sorties")
     * @ORM\JoinColumn(name="organisateur", nullable=false, referencedColumnName="no_participant")
     */
    private $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="sorties")
     * @ORM\JoinColumn(name="lieu_no_lieu", nullable=false, referencedColumnName="no_lieu")
     */
    private $lieu_no_lieu;

    /**
     * @ORM\ManyToOne(targetEntity=Etat::class, inversedBy="sorties")
     * @ORM\JoinColumn(name="etats_no_etat", nullable=false, referencedColumnName="no_etat")
     */
    private $etats_no_etat;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="sortie_no_sortie")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->no_sortie;
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

    public function getDateDebut(): ?string /*?\DateTimeInterface*/
    {
        return $this->date_debut->format('d/m/Y');
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateCloture(): ?string /*?\DateTimeInterface*/
    {
        return $this->date_cloture->format('d/m/Y');
    }

    public function setDateCloture(\DateTimeInterface $date_cloture): self
    {
        $this->date_cloture = $date_cloture;

        return $this;
    }

    public function getNbInscriptionMax(): ?int
    {
        return $this->nb_inscription_max;
    }

    public function setNbInscriptionMax(int $nb_inscription_max): self
    {
        $this->nb_inscription_max = $nb_inscription_max;

        return $this;
    }

    public function getDescriptionInfos(): ?string
    {
        return $this->description_infos;
    }

    public function setDescriptionInfos(?string $description_infos): self
    {
        $this->description_infos = $description_infos;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(?string $url_photo): self
    {
        $this->url_photo = $url_photo;

        return $this;
    }

    public function getOrganisateur(): ?Participant
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Participant $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    public function getLieuNoLieu(): ?Lieu
    {
        return $this->lieu_no_lieu;
    }

    public function setLieuNoLieu(?Lieu $lieu_no_lieu): self
    {
        $this->lieu_no_lieu = $lieu_no_lieu;

        return $this;
    }

    public function getEtatsNoEtat(): ?Etat
    {
        return $this->etats_no_etat;
    }

    public function setEtatsNoEtat(?Etat $etats_no_etat): self
    {
        $this->etats_no_etat = $etats_no_etat;

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setSortieNoSortie($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getSortieNoSortie() === $this) {
                $inscription->setSortieNoSortie(null);
            }
        }

        return $this;
    }

    public function getinscrits(): ?int
    {
        return count($this->getInscriptions());
    }
}
