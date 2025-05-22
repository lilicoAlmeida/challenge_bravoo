<?php

namespace Src\Entity;

use Doctrine\ORM\Mapping as ORM;
use Src\Entity\Person;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact
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
    private string $type;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity="Src\Entity\Person", inversedBy="contacts")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private Person $person;

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}
