<?php namespace App\Models\Repositories;

use App\Models\Contact;

class ContactRepository extends BaseRepository
{

    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

}
