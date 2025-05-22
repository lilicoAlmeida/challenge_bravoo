<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Service\ContactService;

class ContactController
{
    private ContactService $contactService;
    private PersonRepository $personRepository;

    public function __construct(ContactService $contactService, PersonRepository $personRepository)
    {
        $this->contactService = $contactService;
        $this->personRepository = $personRepository;
    }

    public function index(): void
    {
        $page = isset($_GET['pageNum']) ? max(1, (int) $_GET['pageNum']) : 1;
        $limit = 10;

        if (!empty($_GET['search'])) {
            $contacts = $this->contactService->searchByPersonName(trim($_GET['search']));
            $totalPages = 1;
        } else {
            $contacts = $this->contactService->listPaginated($page, $limit);
            $totalRecords = $this->contactService->count();
            $totalPages = (int) ceil($totalRecords / $limit);
        }

        $viewFile = __DIR__ . '/../../views/contact/index.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function create(): void
    {
        $people = $this->personRepository->findLimited(100);

        if (count($people) === 0) {
            header('Location: /?page=person&error=Please register a person before creating a contact.');
            exit;
        }

        $viewFile = __DIR__ . '/../../views/contact/create.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function store(): void
    {
        $description = $_POST['description'] ?? '';
        $type = isset($_POST['type']) ? (int) $_POST['type'] : null;
        $personId = isset($_POST['person_id']) ? (int) $_POST['person_id'] : null;

        if (!$description || !in_array($type, [0, 1], true) || !$personId) {
            header('Location: /?page=contact&action=create&error=All fields are required');
            exit;
        }

        $this->contactService->create($description, $type, $personId);
        header('Location: /?page=contact&action=create&success=1');
        exit;
    }

    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /?page=contact');
            return;
        }

        $contact = $this->contactService->find((int)$id);
        $viewFile = __DIR__ . '/../../views/contact/show.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /?page=contact');
            return;
        }

        $contact = $this->contactService->find((int)$id);
        $people = $this->personRepository->findLimited(100);

        $viewFile = __DIR__ . '/../../views/contact/edit.php';
        include __DIR__ . '/../../views/layout/main.php';
    }

    public function update(): void
    {
        $id = $_POST['id'] ?? null;
        $description = $_POST['description'] ?? '';
        $type = isset($_POST['type']) ? (int) $_POST['type'] : null;
        $personId = isset($_POST['person_id']) ? (int) $_POST['person_id'] : null;

        if (!$id || !$description || !in_array($type, [0, 1], true) || !$personId) {
            header('Location: /?page=contact&action=edit&id=' . $id . '&error=All fields are required');
            exit;
        }

        $this->contactService->update((int)$id, $description, $type, $personId);
        header('Location: /?page=contact&action=edit&id=' . $id . '&success=1');
        exit;
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->contactService->delete((int)$id);
        }

        header('Location: /?page=contact');
    }
}
