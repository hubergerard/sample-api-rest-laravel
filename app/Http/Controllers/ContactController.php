<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mappers\ContactMapper;
use App\Http\Dtos\CreateContactDto;
use App\Http\Dtos\UpdateContactDto;
use App\Services\ContactService;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    private $contactService;
    private $contactMapper;

    public function __construct(ContactService $contactService, ContactMapper $contactMapper)
    {
        $this->contactService = $contactService;
        $this->contactMapper = $contactMapper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $contacts = $this->contactService->findAll();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);

        $contactDto = $this->contactMapper->mapRequestToCreateContactDto($request);
        $this->contactService->create($contactDto);
        return redirect('/contacts')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->contactService->findById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);

        $updateContactDto = $this->contactMapper->mapRequestToUpdateContactDto($request);
        $this->contactService->update($updateContactDto, $id);

        return redirect('/contacts')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->contactService->deleteById($id);
        return redirect('/contacts')->with('success', 'Contact deleted!');
    }
}
