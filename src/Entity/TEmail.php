<?php

namespace App\Entity;

use App\Repository\TEmailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=TEmailRepository::class)
 * @UniqueEntity(
 *  "Email",
 *  message="L'email est déjà là connard"
 * )
 */
class TEmail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank(normalizer = "trim", message = "Merci")
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     * @Assert\Length(
     *      min = 5,
     *      max = 45,
     *      minMessage = "Merci de rentrer un email d'au moins {{ limit }} caractères",
     *      maxMessage = "Merci de ne pas dépasser {{ limit }} caractères"
     * )
     */
    private $Email;

    /**
     * @ORM\OneToMany(targetEntity=TMsg::class, mappedBy="id_Emailmsg")
     */
    private $tMsgs;

    /**
     * @ORM\ManyToMany(targetEntity=TPerson::class, inversedBy="id_EmailPerson")
     */
    private $tPeople;

    public function __construct()
    {
        $this->tMsgs = new ArrayCollection();
        $this->tPeople = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection|TMsg[]
     */
    public function getTMsgs(): Collection
    {
        return $this->tMsgs;
    }

    public function addTMsg(TMsg $tMsg): self
    {
        if (!$this->tMsgs->contains($tMsg)) {
            $this->tMsgs[] = $tMsg;
            $tMsg->setIdEmailmsg($this);
        }

        return $this;
    }

    public function removeTMsg(TMsg $tMsg): self
    {
        if ($this->tMsgs->removeElement($tMsg)) {
            // set the owning side to null (unless already changed)
            if ($tMsg->getIdEmailmsg() === $this) {
                $tMsg->setIdEmailmsg(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TPerson[]
     */
    public function getTPeople(): Collection
    {
        return $this->tPeople;
    }

    public function addTPerson(TPerson $tPerson): self
    {
        if (!$this->tPeople->contains($tPerson)) {
            $this->tPeople[] = $tPerson;
            $tPerson->addIdEmailPerson($this);
        }

        return $this;
    }

    public function removeTPerson(TPerson $tPerson): self
    {
        if ($this->tPeople->removeElement($tPerson)) {
            $tPerson->removeIdEmailPerson($this);
        }

        return $this;
    }
}
