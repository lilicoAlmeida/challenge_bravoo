<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/doctrine.php';

use App\Repository\PersonRepository;
use App\Repository\ContactRepository;
use App\Service\PersonService;
use App\Service\ContactService;
use App\Controller\PersonController;
use App\Controller\ContactController;

// Routing parameters
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Dependency injection
$personRepository = new PersonRepository($entityManager);
$contactRepository = new ContactRepository($entityManager);

$personService = new PersonService($personRepository);
$contactService = new ContactService($contactRepository, $personRepository);

$personController = new PersonController($personService, $personRepository, $contactService);
$contactController = new ContactController($contactService, $personRepository);

// Router
if ($page === 'person') {
    match ($action) {
        'index' => $personController->index(),
        'create' => $personController->create(),
        'store' => $personController->store(),
        'edit' => $personController->edit(),
        'update' => $personController->update(),
        'delete' => $personController->delete(),
        'show' => $personController->show(),
        default => http_response_code(404),
    };
} elseif ($page === 'contact') {
    match ($action) {
        'index' => $contactController->index(),
        'create' => $contactController->create(),
        'store' => $contactController->store(),
        'edit' => $contactController->edit(),
        'update' => $contactController->update(),
        'delete' => $contactController->delete(),
        'show' => $contactController->show(),
        default => http_response_code(404),
    };
} elseif ($page === 'home') {
    $search = $_GET['search'] ?? null;

    if ($search !== null && trim($search) !== '') {
        $people = $personService->searchByName(trim($search));
        $contacts = $contactService->searchByPersonName(trim($search));
    } else {
        $people = $personService->list();
        $contacts = $contactService->list();
    }

    $viewFile = __DIR__ . '/../views/home/index.php';
    include __DIR__ . '/../views/layout/main.php';
} else {
    http_response_code(404);
    echo "Page not found.";
}
