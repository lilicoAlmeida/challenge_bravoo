<?php

namespace Src\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Src\Entity\Contact;

/**
 * @ORM\Entity
 * @ORM\Table(name="people")
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $cpf;

    /**
     * @ORM\OneToMany(targetEntity="Src\Entity\Contact", mappedBy="person", cascade={"persist", "remove"})
     */
    private Collection $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): void
    {
        $this->contacts[] = $contact;
        $contact->setPerson($this);
    }
}
