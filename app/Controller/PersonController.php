<?php

namespace App\Controller;

use App\Service\PersonService;
use App\Repository\PersonRepository;
use App\Service\ContactService;

class PersonController
{
    private PersonService $personService;
    private PersonRepository $personRepository;
    private ContactService $contactService;

    public function __construct(
        PersonService $personService,
        PersonRepository $personRepository,
        ContactService $contactService
    ) {
        $this->personService = $personService;
        $this->personRepository = $personRepository;
        $this->contactService = $contactService;
    }

    public function index(): void
    {
        $page = isset($_GET['pageNum']) ? max(1, (int) $_GET['pageNum']) : 1;
        $limit = 10;

        if (!empty($_GET['search'])) {
            $people = $this->personService->searchByName(trim($_GET['search']));
            $totalPages = 1;
        } else {
            $people = $this->personService->listPaginated($page, $limit);
            $totalRecords = $this->personService->count();
            $totalPages = (int) ceil($totalRecords / $limit);
        }

        $viewFile = __DIR__ . '/../../views/person/index.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function create(): void
    {
        $viewFile = __DIR__ . '/../../views/person/create.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $cpf = $_POST['cpf'] ?? '';

        if (!$name || !$cpf) {
            header('Location: /?page=person&action=create&error=Name and CPF are required');
            exit;
        }

        $this->personService->create($name, $cpf);
        header('Location: /?page=person&action=create&success=1');
        exit;
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /?page=person');
            return;
        }

        $person = $this->personService->find((int)$id);
        $viewFile = __DIR__ . '/../../views/person/edit.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function update(): void
    {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $cpf = $_POST['cpf'] ?? '';

        if (!$id || !$name || !$cpf) {
            header('Location: /?page=person&action=edit&id=' . $id . '&error=All fields are required');
            exit;
        }

        $this->personService->update((int)$id, $name, $cpf);
        header('Location: /?page=person&action=edit&id=' . $id . '&success=1');
        exit;
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->personService->delete((int)$id);
        }

        header('Location: /?page=person');
    }

    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /?page=person');
            return;
        }

        $person = $this->personService->find((int)$id);
        $viewFile = __DIR__ . '/../../views/person/show.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function home(): void
    {
        $search = $_GET['search'] ?? null;

        if ($search !== null && trim($search) !== '') {
            $people = $this->personService->searchByName(trim($search));
            $contacts = $this->contactService->searchByPersonName(trim($search));
        } else {
            $people = $this->personService->list();
            $contacts = $this->contactService->list();
        }

        $viewFile = __DIR__ . '/../../views/home/index.php';
        include __DIR__ . '/../../views/layout/main.php';
    }
}
