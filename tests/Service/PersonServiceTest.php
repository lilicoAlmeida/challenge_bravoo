<?php

use PHPUnit\Framework\TestCase;
use App\Service\PersonService;
use App\Repository\PersonRepository;
use Src\Entity\Person;

class PersonServiceTest extends TestCase
{
    public function testCreatePerson()
    {
        $mockRepository = $this->createMock(PersonRepository::class);

        $mockRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Person::class));

        $service = new PersonService($mockRepository);
        $service->create("John Doe", "123.456.789-00");
    }
}
