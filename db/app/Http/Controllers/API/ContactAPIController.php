<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContactAPIRequest;
use App\Http\Requests\API\UpdateContactAPIRequest;
use App\Models\Contact;
use App\Models\Personne;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContactResource;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContactAPIController
 */
class ContactAPIController extends AppBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }

    /**
     * Display a listing of the Contacts.
     * GET|HEAD /contacts
     */
    public function index(Request $request): JsonResponse
    {
        $contacts = $this->contactRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        // Load the related personne for each contact
        $contacts->load('personne');

        return $this->sendResponse(ContactResource::collection($contacts), 'Contacts retrieved successfully');
    }

    /**
     * Store a newly created Contact in storage.
     * POST /contacts
     */
    public function store(CreateContactAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $personne = Personne::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'genre' => $request->input('genre'),
            'email' => $request->input('email'),
            'phonenumber' => $request->input('phonenumber'),
            'deleted_at' => null,
        ]);

        // Create a new contact associated with the person
        $contact = new Contact([
            'fonction' => $request->input('fonction'),
            // Add other fields specific to the Contact model
        ]);

        // Associate the contact with the person
        $personne->contact()->save($contact);

        // Return a response, maybe the created contact
        return response()->json($contact, 201);
    }

    /**
     * Display the specified Contact.
     * GET|HEAD /contacts/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);
        $contact->load('personne');

        if (empty($contact)) {
            return $this->sendError('Contact not found');
        }


        return $this->sendResponse(new ContactResource($contact), 'Contact retrieved successfully');
    }

    /**
     * Update the specified Contact in storage.
     * PUT/PATCH /contacts/{id}
     */
    public function update($id, UpdateContactAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            return $this->sendError('Contact not found');
        }

        $contact = $this->contactRepository->update($input, $id);
        $personne = $contact->personne;
        if ($personne) {
            $personne->update($input);
            // Update avatar based on genre
            $personne->update([
                'avatar' => $personne->genre === 'male' ? 'public/images/male.jpg' : 'public/images/female.jpg',
            ]);
        }

        return $this->sendResponse(new ContactResource($contact), 'Contact updated successfully');
    }

    /**
     * Remove the specified Contact from storage.
     * DELETE /contacts/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            return $this->sendError('Contact not found');
        }

        // Delete associated personne with soft delete
        $personne = $contact->personne;
        if ($personne) {
            $personne->delete();
        }

        $contact->delete();

        return $this->sendSuccess('Contact deleted successfully');
    }

    /**
     * Display a listing of soft-deleted Contacts.
     * GET /contacts/deleted
     */
    public function deletedContacts(): JsonResponse
    {

        // Retrieve only soft-deleted contacts
        $softDeletedContacts = Contact::onlyTrashed()->get();

        return $this->sendResponse(ContactResource::collection($softDeletedContacts), 'Soft-deleted Contacts retrieved successfully');
    }
}
