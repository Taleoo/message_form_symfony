<?php

namespace App\Entity;


use App\Repository\TMsgRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TMsgRepository")
 * 

 */
class TMsg
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Merci de rentrer un sujet d'au moins {{ limit }} caractères",
     *      maxMessage = "Merci de ne pas dépasser {{ limit }} caractères"
     * )
     */
    private $Subject;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 5,
     *      max = 999,
     *      minMessage = "Merci de rentrer un message d'au moins {{ limit }} caractères",
     *      maxMessage = "Merci de ne pas dépasser {{ limit }} caractères"
     * )
     */
    private $msg;

    /**
     * @ORM\ManyToOne(targetEntity=TEmail::class, inversedBy="tMsgs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_Emailmsg;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $State;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }

    public function getMsg(): ?string
    {
        return $this->msg;
    }

    public function setMsg(string $msg): self
    {
        $this->msg = $msg;

        return $this;
    }

    public function getIdEmailmsg(): ?TEmail
    {
        return $this->id_Emailmsg;
    }

    public function setIdEmailmsg(?TEmail $id_Emailmsg): self
    {
        $this->id_Emailmsg = $id_Emailmsg;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(string $State): self
    {
        $this->State = $State;

        return $this;
    }
}
