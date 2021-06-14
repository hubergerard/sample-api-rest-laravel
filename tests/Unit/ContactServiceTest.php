<?php


use App\Http\Dtos\UpdateContactDto;
use App\Models\Contact;
use App\Models\Repositories\ContactRepository;
use App\Services\ContactService;
use PHPUnit\Framework\TestCase;

class ContactServiceTest extends TestCase
{


    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_update()
    {
        $id = 1;

        $returnedContact = new Contact();

        $dto = new UpdateContactDto();
        $dto->firstName = 'Bob';

        $mock = Mockery::mock(ContactRepository::class);
        $mock->shouldReceive('findById')->once()
            ->with($id)->andReturn($returnedContact);
        $mock->shouldReceive('save')->once()
            ->with(Contact::class)
            ->with(Mockery::on(function ($contact) use ($dto) {
                $assertFieldsComeFromDto = [
                    $contact['first_name'] == $dto->firstName,
                    $contact['last_name'] == $dto->lastName,
                    $contact['city'] == $dto->city,
                    $contact['country'] == $dto->country,
                    $contact['job_title'] == $dto->jobTitle,
                    $contact['email'] == $dto->email];
                return count(array_filter($assertFieldsComeFromDto)) == count($assertFieldsComeFromDto);
            }));

        $service = new ContactService($mock);
        $service->update($dto, $id);
        $this->expectNotToPerformAssertions();
    }
}
