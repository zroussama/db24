<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContactAPIRequest;
use App\Http\Requests\API\UpdateContactAPIRequest;
use App\Http\Requests\API\CreatePersonneAPIRequest;
use App\Http\Requests\API\UpdatePersonneAPIRequest;
use App\Models\Personne;
use App\Repositories\PersonneRepository;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PersonneResource;
use App\Http\Resources\ContactResource;

/**
 * Class ContactPersonController
 */
class ContactPersonController extends AppBaseController
{
    /** @var PersonneRepository */
    private $personneRepository;

    /** @var ContactRepository */
    private $contactRepository;

    public function __construct(PersonneRepository $personneRepo, ContactRepository $contactRepo)
    {
        $this->personneRepository = $personneRepo;
        $this->contactRepository = $contactRepo;
    }

    /**
     * Store a newly created Contact and associated Personne in storage.
     * POST /contact-persons
     */
    public function store(CreatePersonneAPIRequest $request): JsonResponse
    {
        $personneData = $request->only([
            'firstName',
            'lastName',
            'genre',
            'email',
            'phonenumber',
        ]);

        // Add logic to set the avatar based on the genre
        $genre = $request->input('genre');
        $avatar = $genre === 'male' ? 'public/images/male.jpg' : 'public/images/female.jpg';

        // Add the avatar to the person data
        $personneData['avatar'] = $avatar;

        // Create a new person
        $personne = $this->personneRepository->create($personneData);

        // Create a new contact associated with the person
        $contactData = [
            'fonction' => $request->input('fonction'),
            // Add other fields for the Contact model
        ];

        // Assuming you have a relationship with a Contact
        $contact = $personne->contacts()->create($contactData);

        // Return a response, maybe the created contact
        return $this->sendResponse(new ContactResource($contact), 'Contact saved successfully');
    }
    // public function store(CreatePersonneAPIRequest $request): JsonResponse
    // {
    //     // Validate the request

    //     // Create a new person
    //     $personne = $this->personneRepository->create($request->all());

    //     // Create a new contact associated with the person
    //     $contact = $this->contactRepository->create([
    //         'fonction' => $request->input('fonction'),
    //         // Add other fields
    //     ]);

    //     // Associate the contact with the person
    //     $personne->contacts()->save($contact);

    //     // Return a response, maybe the created contact
    //     return $this->sendResponse(new ContactResource($contact), 'Contact saved successfully');
    // }

    /**
     * Update the specified Contact and associated Personne in storage.
     * PUT/PATCH /contact-persons/{id}
     */
    public function update($id, UpdatePersonneAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        // Find the existing Personne
        $personne = $this->personneRepository->find($id);

        if (empty($personne)) {
            return $this->sendError('Personne not found');
        }

        // Update the existing Personne
        $personne = $this->personneRepository->update($input, $id);

        // Update the associated Contact
        $contact = $personne->contact;
        if (!empty($contact)) {
            $contact->update([
                'fonction' => $request->input('fonction'),
                // Add other fields
            ]);
        }

        return $this->sendResponse(new PersonneResource($personne), 'Personne and Contact updated successfully');
    }

    /**
     * Remove the specified Contact and associated Personne from storage.
     * DELETE /contact-persons/{id}
     */
    public function destroy($id): JsonResponse
    {
        // Find the existing Personne
        $personne = $this->personneRepository->find($id);

        if (empty($personne)) {
            return $this->sendError('Personne not found');
        }

        // Delete the associated Contact
        $contact = $personne->contact;
        if (!empty($contact)) {
            $contact->delete();
        }

        // Delete the Personne
        $personne->delete();

        return $this->sendSuccess('Personne and Contact deleted successfully');
    }
}
