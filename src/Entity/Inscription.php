<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Sortie::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(name="sortie_no_sortie", nullable=false, referencedColumnName="no_sortie")
     */
    private $sortie_no_sortie;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Participant::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(name="participant_no_participant", nullable=false, referencedColumnName="no_participant")
     */
    private $participant_no_participant;

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getSortieNoSortie(): ?Sortie
    {
        return $this->sortie_no_sortie;
    }

    public function setSortieNoSortie(?Sortie $sortie_no_sortie): self
    {
        $this->sortie_no_sortie = $sortie_no_sortie;

        return $this;
    }

    public function getParticipantNoParticipant(): ?Participant
    {
        return $this->participant_no_participant;
    }

    public function setParticipantNoParticipant(?Participant $participant_no_participant): self
    {
        $this->participant_no_participant = $participant_no_participant;

        return $this;
    }
}
