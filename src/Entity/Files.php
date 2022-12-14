<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FilesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FilesRepository::class)
 */
class Files
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Modules::class, inversedBy="files")
     */
    private $module;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Telechargements::class, inversedBy="files")
     */
    private $telechargements;

    /**
     * @ORM\ManyToOne(targetEntity=TableauNotes::class, inversedBy="copie")
     */
    private $tableauNotes;

    /**
     * @ORM\ManyToOne(targetEntity=TableauAbsences::class, inversedBy="copie")
     */
    private $tableauAbsences;

    /**
     * @ORM\ManyToOne(targetEntity=Messages::class, inversedBy="files")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Docadmins::class, inversedBy="files")
     */
    private $docadmins;

    /**
     * @ORM\ManyToOne(targetEntity=TableauAbsencesintervenants::class, inversedBy="copie")
     */
    private $tableauAbsencesintervenants;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="files")
     */
    private $cours;



  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelechargements(): ?Telechargements
    {
        return $this->telechargements;
    }

    public function setTelechargements(?Telechargements $telechargements): self
    {
        $this->telechargements = $telechargements;

        return $this;
    }

    public function getTableauNotes(): ?TableauNotes
    {
        return $this->tableauNotes;
    }

    public function setTableauNotes(?TableauNotes $tableauNotes): self
    {
        $this->tableauNotes = $tableauNotes;

        return $this;
    }

    public function getTableauAbsences(): ?TableauAbsences
    {
        return $this->tableauAbsences;
    }

    public function setTableauAbsences(?TableauAbsences $tableauAbsences): self
    {
        $this->tableauAbsences = $tableauAbsences;

        return $this;
    }

    public function getMessages(): ?Messages
    {
        return $this->messages;
    }

    public function setMessages(?Messages $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function getDocadmins(): ?Docadmins
    {
        return $this->docadmins;
    }

    public function setDocadmins(?Docadmins $docadmins): self
    {
        $this->docadmins = $docadmins;

        return $this;
    }

    public function getTableauAbsencesintervenants(): ?TableauAbsencesintervenants
    {
        return $this->tableauAbsencesintervenants;
    }

    public function setTableauAbsencesintervenants(?TableauAbsencesintervenants $tableauAbsencesintervenants): self
    {
        $this->tableauAbsencesintervenants = $tableauAbsencesintervenants;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }




}
