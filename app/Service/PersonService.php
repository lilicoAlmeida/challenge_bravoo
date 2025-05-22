<?php

namespace App\Service;

use App\Repository\PersonRepository;
use Src\Entity\Person;

class PersonService
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function list(): array
    {
        return $this->personRepository->findPaginated(1, 10); // default fallback
    }

    public function listPaginated(int $page = 1, int $limit = 10): array
    {
        return $this->personRepository->findPaginated($page, $limit);
    }

    public function count(): int
    {
        return $this->personRepository->countAll();
    }

    public function searchByName(string $name): array
    {
        return $this->personRepository->searchByName($name);
    }

    public function find(int $id): ?Person
    {
        return $this->personRepository->find($id);
    }

    public function create(string $name, string $cpf): void
    {
        $person = new Person();
        $person->setName($name);
        $person->setCpf($cpf);

        $this->personRepository->save($person);
    }

    public function update(int $id, string $name, string $cpf): void
    {
        $person = $this->personRepository->find($id);
        if ($person) {
            $person->setName($name);
            $person->setCpf($cpf);
            $this->personRepository->save($person);
        }
    }

    public function delete(int $id): void
    {
        $person = $this->personRepository->find($id);
        if ($person) {
            $this->personRepository->remove($person);
        }
    }
}
