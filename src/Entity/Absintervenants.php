<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AbsintervenantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbsintervenantsRepository::class)
 */
#[ApiResource]
class Absintervenants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Intervenants::class, inversedBy="absintervenants")
     */
    private $intervenant;

    /**
     * @ORM\ManyToOne(targetEntity=Modules::class, inversedBy="absintervenants")
     */
    private $module;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $created_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $du;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $au;

    /**
     * @ORM\ManyToOne(targetEntity=Classes::class, inversedBy="absintervenants")
     */
    private $classe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $absent;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateabsence;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enretard;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateretard;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $present;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datepresence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userid;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="absintervenants")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=TableauAbsencesintervenants::class, mappedBy="absences")
     */
    private $tableauAbsencesintervenants;


    public function __construct()
    {
        $this->intervenant = new ArrayCollection();
        $this->tableauAbsencesintervenants = new ArrayCollection();
     
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Intervenants>
     */
    public function getIntervenant(): Collection
    {
        return $this->intervenant;
    }

    public function addIntervenant(Intervenants $intervenant): self
    {
        if (!$this->intervenant->contains($intervenant)) {
            $this->intervenant[] = $intervenant;
        }

        return $this;
    }

    public function removeIntervenant(Intervenants $intervenant): self
    {
        $this->intervenant->removeElement($intervenant);

        return $this;
    }

    public function getModule(): ?Modules
    {
        return $this->module;
    }

    public function setModule(?Modules $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(?string $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getDu(): ?\DateTimeInterface
    {
        return $this->du;
    }

    public function setDu(?\DateTimeInterface $du): self
    {
        $this->du = $du;

        return $this;
    }

    public function getAu(): ?\DateTimeInterface
    {
        return $this->au;
    }

    public function setAu(?\DateTimeInterface $au): self
    {
        $this->au = $au;

        return $this;
    }

    public function getClasse(): ?Classes
    {
        return $this->classe;
    }

    public function setClasse(?Classes $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function isAbsent(): ?bool
    {
        return $this->absent;
    }

    public function setAbsent(?bool $absent): self
    {
        $this->absent = $absent;

        return $this;
    }

    public function getDateabsence(): ?\DateTimeInterface
    {
        return $this->dateabsence;
    }

    public function setDateabsence(?\DateTimeInterface $dateabsence): self
    {
        $this->dateabsence = $dateabsence;

        return $this;
    }

    public function isEnretard(): ?bool
    {
        return $this->enretard;
    }

    public function setEnretard(?bool $enretard): self
    {
        $this->enretard = $enretard;

        return $this;
    }

    public function getDateretard(): ?\DateTimeInterface
    {
        return $this->dateretard;
    }

    public function setDateretard(?\DateTimeInterface $dateretard): self
    {
        $this->dateretard = $dateretard;

        return $this;
    }

    public function isPresent(): ?bool
    {
        return $this->present;
    }

    public function setPresent(?bool $present): self
    {
        $this->present = $present;

        return $this;
    }

    public function getDatepresence(): ?\DateTimeInterface
    {
        return $this->datepresence;
    }

    public function setDatepresence(?\DateTimeInterface $datepresence): self
    {
        $this->datepresence = $datepresence;

        return $this;
    }

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(?string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, TableauAbsencesintervenants>
     */
    public function getTableauAbsencesintervenants(): Collection
    {
        return $this->tableauAbsencesintervenants;
    }

    public function addTableauAbsencesintervenant(TableauAbsencesintervenants $tableauAbsencesintervenant): self
    {
        if (!$this->tableauAbsencesintervenants->contains($tableauAbsencesintervenant)) {
            $this->tableauAbsencesintervenants[] = $tableauAbsencesintervenant;
            $tableauAbsencesintervenant->addAbsence($this);
        }

        return $this;
    }

    public function removeTableauAbsencesintervenant(TableauAbsencesintervenants $tableauAbsencesintervenant): self
    {
        if ($this->tableauAbsencesintervenants->removeElement($tableauAbsencesintervenant)) {
            $tableauAbsencesintervenant->removeAbsence($this);
        }

        return $this;
    }


}
