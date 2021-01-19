<?php

namespace App\Entity;

use App\Repository\TPersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TPersonRepository::class)
 */
class TPerson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $Phone;

    /**
     * @ORM\ManyToMany(targetEntity=TEmail::class, mappedBy="tPeople")
     */
    private $id_EmailPerson;

    public function __construct(string $First, string $Last, string $Phone)
    {   
        $this->FirstName = $First;
        $this->LastName = $Last;
        $this->Phone = $Phone;
        $this->id_EmailPerson = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(?string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    /**
     * @return Collection|TEmail[]
     */
    public function getIdEmailPerson(): Collection
    {
        return $this->id_EmailPerson;
    }

    public function addIdEmailPerson(TEmail $idEmailPerson): self
    {
        if (!$this->id_EmailPerson->contains($idEmailPerson)) {
            $this->id_EmailPerson[] = $idEmailPerson;
        }

        return $this;
    }

    public function removeIdEmailPerson(TEmail $idEmailPerson): self
    {
        $this->id_EmailPerson->removeElement($idEmailPerson);

        return $this;
    }
}
