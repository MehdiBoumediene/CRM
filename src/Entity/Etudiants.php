<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EtudiantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EtudiantsRepository::class)
 */
class Etudiants
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity=Modules::class, inversedBy="etudiants")
     */
    private $modules;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $created_by;

    /**
     * @ORM\ManyToMany(targetEntity=Absences::class, mappedBy="etudiant")
     */
    private $absences;

    /**
     * @ORM\ManyToOne(targetEntity=Classes::class, inversedBy="etudiants")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="etudiants",cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Tuteurs::class, inversedBy="etudiants")
     */
    private $tuteurs;

    /**
     * @ORM\ManyToOne(targetEntity=Codepostal::class, inversedBy="etudiants")
     */
    private $codepostale;

    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="etudiants")
     */
    private $ville;

    /**
     * @ORM\ManyToMany(targetEntity=TableauNotes::class, mappedBy="etudiant")
     */
    private $tableauNotes;

    /**
     * @ORM\ManyToMany(targetEntity=TableauAbsences::class, mappedBy="etudiant")
     */
    private $tableauAbsences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cursus;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprises::class, inversedBy="etudiants")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Intervenants::class, inversedBy="apprenants")
     */
    private $intervenants;

    /**
     * @ORM\OneToMany(targetEntity=Notifications::class, mappedBy="etudiant")
     */
    private $notifications;







   


    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->tuteurs = new ArrayCollection();
        $this->tableauNotes = new ArrayCollection();
        $this->tableauAbsences = new ArrayCollection();
        $this->notifications = new ArrayCollection();

   
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Modules>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Modules $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
        }

        return $this;
    }

    public function removeModule(Modules $module): self
    {
        $this->modules->removeElement($module);

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
            $absence->addEtudiant($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            $absence->removeEtudiant($this);
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
     * @return Collection<int, Tuteurs>
     */
    public function getTuteurs(): Collection
    {
        return $this->tuteurs;
    }

    public function addTuteur(Tuteurs $tuteur): self
    {
        if (!$this->tuteurs->contains($tuteur)) {
            $this->tuteurs[] = $tuteur;
        }

        return $this;
    }

    public function removeTuteur(Tuteurs $tuteur): self
    {
        $this->tuteurs->removeElement($tuteur);

        return $this;
    }

    public function getCodepostale(): ?Codepostal
    {
        return $this->codepostale;
    }

    public function setCodepostale(?Codepostal $codepostale): self
    {
        $this->codepostale = $codepostale;

        return $this;
    }

    public function getVille(): ?Villes
    {
        return $this->ville;
    }

    public function setVille(?Villes $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, TableauNotes>
     */
    public function getTableauNotes(): Collection
    {
        return $this->tableauNotes;
    }

    public function addTableauNote(TableauNotes $tableauNote): self
    {
        if (!$this->tableauNotes->contains($tableauNote)) {
            $this->tableauNotes[] = $tableauNote;
            $tableauNote->addEtudiant($this);
        }

        return $this;
    }

    public function removeTableauNote(TableauNotes $tableauNote): self
    {
        if ($this->tableauNotes->removeElement($tableauNote)) {
            $tableauNote->removeEtudiant($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, TableauAbsences>
     */
    public function getTableauAbsences(): Collection
    {
        return $this->tableauAbsences;
    }

    public function addTableauAbsence(TableauAbsences $tableauAbsence): self
    {
        if (!$this->tableauAbsences->contains($tableauAbsence)) {
            $this->tableauAbsences[] = $tableauAbsence;
            $tableauAbsence->addEtudiant($this);
        }

        return $this;
    }

    public function removeTableauAbsence(TableauAbsences $tableauAbsence): self
    {
        if ($this->tableauAbsences->removeElement($tableauAbsence)) {
            $tableauAbsence->removeEtudiant($this);
        }

        return $this;
    }

    public function getCursus(): ?string
    {
        return $this->cursus;
    }

    public function setCursus(?string $cursus): self
    {
        $this->cursus = $cursus;

        return $this;
    }

    public function getEntreprise(): ?Entreprises
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprises $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getIntervenants(): ?Intervenants
    {
        return $this->intervenants;
    }

    public function setIntervenants(?Intervenants $intervenants): self
    {
        $this->intervenants = $intervenants;

        return $this;
    }

    /**
     * @return Collection<int, Notifications>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notifications $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setEtudiant($this);
        }

        return $this;
    }

    public function removeNotification(Notifications $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getEtudiant() === $this) {
                $notification->setEtudiant(null);
            }
        }

        return $this;
    }

 

   

}
