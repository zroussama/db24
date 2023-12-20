<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContactAPIRequest;
use App\Http\Requests\API\UpdateContactAPIRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContactResource;

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

        $contact = $this->contactRepository->create($input);

        return $this->sendResponse(new ContactResource($contact), 'Contact saved successfully');
    }

    /**
     * Display the specified Contact.
     * GET|HEAD /contacts/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Contact $contact */
        $contact = $this->contactRepository->find($id);

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

        $contact->delete();

        return $this->sendSuccess('Contact deleted successfully');
    }
}
