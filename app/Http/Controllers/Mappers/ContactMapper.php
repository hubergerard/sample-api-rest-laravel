<?php

namespace App\Http\Controllers\Mappers;

use App\Http\Dtos\CreateContactDto;
use App\Http\Dtos\UpdateContactDto;
use App\Models\Repositories\ContactRepository;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Mockery;

class ContactMapper {

    public function mapRequestToCreateContactDto(Request $request) {

        $contactDto = new CreateContactDto();
        $contactDto->city = $request->get('city');
        $contactDto->lastName = $request->get('last_name');
        $contactDto->email = $request->get('email');
        $contactDto->jobTitle = $request->get('job_title');
        $contactDto->firstName = $request->get('first_name');
        $contactDto->country = $request->get('country');
        return $contactDto;
    }

    public function mapRequestToUpdateContactDto(Request $request) {
        $contactDto = new UpdateContactDto();
        $contactDto->city = $request->get('city');
        $contactDto->lastName = $request->get('last_name');
        $contactDto->email = $request->get('email');
        $contactDto->jobTitle = $request->get('job_title');
        $contactDto->firstName = $request->get('first_name');
        $contactDto->country = $request->get('country');
        return $contactDto;
    }
}
