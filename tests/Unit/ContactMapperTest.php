<?php

namespace Tests\Unit;

use App\Http\Controllers\Mappers\ContactMapper;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class ContactMapperTest extends TestCase {

    public function test_mapRequestToCreateContactDto() {

        // Initialisation
        $firstName = 'Bob';
        $lastName = 'Dylan';
        $city = 'NYC';
        $country = 'USA';
        $email = 'test@test.fr';
        $jobTitle = 'Singer';

        $request = new Request();
        $request->replace(['first_name' => $firstName,
            'last_name'=> $lastName,
            'city'=> $city,
            'country'=> $country,
            'email'=> $email,
            'job_title' => $jobTitle]);

        $mapper = new ContactMapper();

        // Exécution
        $dto = $mapper->mapRequestToCreateContactDto($request);

        // Assertion
        $this->assertEquals($dto->firstName, $firstName);
        $this->assertEquals($dto->lastName, $lastName);
        $this->assertEquals($dto->city, $city);
        $this->assertEquals($dto->country, $country);
        $this->assertEquals($dto->email, $email);
        $this->assertEquals($dto->jobTitle, $jobTitle);

    }
}
