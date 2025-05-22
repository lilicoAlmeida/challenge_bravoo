<?php

namespace App\Service;

use App\Repository\ContactRepository;
use App\Repository\PersonRepository;
use Src\Entity\Contact;

class ContactService
{
    private ContactRepository $contactRepository;
    private PersonRepository $personRepository;

    public function __construct(ContactRepository $contactRepository, PersonRepository $personRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->personRepository = $personRepository;
    }

    public function list(): array
    {
        return $this->contactRepository->findPaginated(1, 10); // fallback
    }

    public function listPaginated(int $page = 1, int $limit = 10): array
    {
        return $this->contactRepository->findPaginated($page, $limit);
    }

    public function count(): int
    {
        return $this->contactRepository->countAll();
    }

    public function searchByPersonName(string $name): array
    {
        return $this->contactRepository->searchByPersonName($name);
    }

    public function find(int $id): ?Contact
    {
        return $this->contactRepository->find($id);
    }

    public function create(string $description, int $type, int $personId): void
    {
        $person = $this->personRepository->find($personId);
        if (!$person) return;

        $contact = new Contact();
        $contact->setDescription($description);
        $contact->setType($type);
        $contact->setPerson($person);

        $this->contactRepository->save($contact);
    }

    public function update(int $id, string $description, int $type, int $personId): void
    {
        $contact = $this->contactRepository->find($id);
        if (!$contact) return;

        $person = $this->personRepository->find($personId);
        if (!$person) return;

        $contact->setDescription($description);
        $contact->setType($type);
        $contact->setPerson($person);

        $this->contactRepository->save($contact);
    }

    public function delete(int $id): void
    {
        $contact = $this->contactRepository->find($id);
        if ($contact) {
            $this->contactRepository->remove($contact);
        }
    }
}
