<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ModulesRepository::class)
 */
class Modules
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Blocs::class, inversedBy="modules")
     */
    private $bloc;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $created_by;

    /**
     * @ORM\ManyToMany(targetEntity=Intervenants::class, mappedBy="modules")
     */
    private $intervenants;

    /**
     * @ORM\ManyToMany(targetEntity=Etudiants::class, mappedBy="modules")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity=Absences::class, mappedBy="module")
     */
    private $absences;

    /**
     * @ORM\OneToMany(targetEntity=Documents::class, mappedBy="module", cascade={"all"})
     */
    private $documents;

    /**
     * @ORM\ManyToOne(targetEntity=Classes::class, inversedBy="modules")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="module")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Calendrier::class, mappedBy="module")
     */
    private $calendriers;

      /**
     * @ORM\OneToMany(targetEntity=Files::class, mappedBy="module", cascade={"all"})
     */
    private $files;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coefficient;

    /**
     * @ORM\OneToMany(targetEntity=Notes::class, mappedBy="module")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="module")
     */
    private $cours;

    /**
     * @ORM\OneToOne(targetEntity=Telechargements::class, mappedBy="module", cascade={"persist", "remove"})
     */
    private $telechargements;

    /**
     * @ORM\OneToMany(targetEntity=Absintervenants::class, mappedBy="module")
     */
    private $absintervenants;

 



    public function __toString() {
        return $this->nom;
    }
   

    public function __construct()
    {
        $this->intervenants = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->calendriers = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->absintervenants = new ArrayCollection();

        
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

    public function getBloc(): ?Blocs
    {
        return $this->bloc;
    }

    public function setBloc(?Blocs $bloc): self
    {
        $this->bloc = $bloc;

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

    /**
     * @return Collection<int, Intervenants>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Intervenants $intervenant): self
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants[] = $intervenant;
            $intervenant->addModule($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenants $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            $intervenant->removeModule($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Etudiants>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiants $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->addModule($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiants $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            $etudiant->removeModule($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Absences>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absences $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setModule($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getModule() === $this) {
                $absence->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Documents>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Documents $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setModule($this);
        }

        return $this;
    }

    public function removeDocument(Documents $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getModule() === $this) {
                $document->setModule(null);
            }
        }

        return $this;
    }

    public function getClasses(): ?Classes
    {
        return $this->classes;
    }

    public function setClasses(?Classes $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Calendrier>
     */
    public function getCalendriers(): Collection
    {
        return $this->calendriers;
    }

    public function addCalendrier(Calendrier $calendrier): self
    {
        if (!$this->calendriers->contains($calendrier)) {
            $this->calendriers[] = $calendrier;
            $calendrier->setModule($this);
        }

        return $this;
    }

    public function removeCalendrier(Calendrier $calendrier): self
    {
        if ($this->calendriers->removeElement($calendrier)) {
            // set the owning side to null (unless already changed)
            if ($calendrier->getModule() === $this) {
                $calendrier->setModule(null);
            }
        }

        return $this;
    }

 /**
     * @return Collection<int, Files>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(Files $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setModule($this);
        }

        return $this;
    }

    public function removeFile(Files $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getModule() === $this) {
                $file->setModule(null);
            }
        }

        return $this;
    }

    public function getCoefficient(): ?string
    {
        return $this->coefficient;
    }

    public function setCoefficient(?string $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * @return Collection<int, Notes>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setModule($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getModule() === $this) {
                $note->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setModule($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getModule() === $this) {
                $cour->setModule(null);
            }
        }

        return $this;
    }

    public function getTelechargements(): ?Telechargements
    {
        return $this->telechargements;
    }

    public function setTelechargements(?Telechargements $telechargements): self
    {
        // unset the owning side of the relation if necessary
        if ($telechargements === null && $this->telechargements !== null) {
            $this->telechargements->setModule(null);
        }

        // set the owning side of the relation if necessary
        if ($telechargements !== null && $telechargements->getModule() !== $this) {
            $telechargements->setModule($this);
        }

        $this->telechargements = $telechargements;

        return $this;
    }

    /**
     * @return Collection<int, Absintervenants>
     */
    public function getAbsintervenants(): Collection
    {
        return $this->absintervenants;
    }

    public function addAbsintervenant(Absintervenants $absintervenant): self
    {
        if (!$this->absintervenants->contains($absintervenant)) {
            $this->absintervenants[] = $absintervenant;
            $absintervenant->setModule($this);
        }

        return $this;
    }

    public function removeAbsintervenant(Absintervenants $absintervenant): self
    {
        if ($this->absintervenants->removeElement($absintervenant)) {
            // set the owning side to null (unless already changed)
            if ($absintervenant->getModule() === $this) {
                $absintervenant->setModule(null);
            }
        }

        return $this;
    }


  

}