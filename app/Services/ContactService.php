<?php

namespace App\Services;

use App\Http\Dtos\CreateContactDto;
use App\Http\Dtos\UpdateContactDto;
use App\Models\Contact;
use App\Models\Repositories\ContactRepository;

class ContactService
{

    private $contactRepository;

    public function __construct(ContactRepository $contactRepository) {
        $this->contactRepository = $contactRepository;
    }

    public function findById(int $id)
    {
        return $this->contactRepository->findById($id);
    }

    public function findAll()
    {
        return $this->contactRepository->findAll();
    }

    public function create(CreateContactDto $dto)
    {
        $contact = new Contact();
        $contact->fill([
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'email' => $dto->email,
            'job_title' => $dto->jobTitle,
            'city' => $dto->city,
            'country' => $dto->country
        ]);
        $this->contactRepository->save($contact);
    }

    public function update(UpdateContactDto $dto, int $id) {
        $contact = $this->contactRepository->findById($id);
        $contact->fill([
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'email' => $dto->email,
            'job_title' => $dto->jobTitle,
            'city' => $dto->city,
            'country' => $dto->country
        ]);
        echo $contact;
        $this->contactRepository->save($contact);

    }

    public function deleteById(int $id)
    {
        $this->contactRepository->deleteByIds($id);
    }
}
