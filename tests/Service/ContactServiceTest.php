<?php

use PHPUnit\Framework\TestCase;
use App\Service\ContactService;
use App\Repository\ContactRepository;
use App\Repository\PersonRepository;
use Src\Entity\Person;

class ContactServiceTest extends TestCase
{
    public function testCreateContact()
    {
        $mockContactRepo = $this->createMock(ContactRepository::class);
        $mockPersonRepo = $this->createMock(PersonRepository::class);

        $mockPerson = $this->createMock(Person::class);

        $mockPersonRepo->method('find')->with(1)->willReturn($mockPerson);

        $mockContactRepo->expects($this->once())
            ->method('save');

        $service = new ContactService($mockContactRepo, $mockPersonRepo);
        $service->create("99999-9999", 1, 1); // description, type, person_id
    }
}
