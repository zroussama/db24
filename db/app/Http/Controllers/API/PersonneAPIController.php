<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePersonneAPIRequest;
use App\Http\Requests\API\UpdatePersonneAPIRequest;
use App\Models\Personne;
use App\Repositories\PersonneRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PersonneResource;

/**
 * Class PersonneAPIController
 */
class PersonneAPIController extends AppBaseController
{
    /** @var  PersonneRepository */
    private $personneRepository;

    public function __construct(PersonneRepository $personneRepo)
    {
        $this->personneRepository = $personneRepo;
    }

    /**
     * Display a listing of the Personnes.
     * GET|HEAD /personnes
     */
    public function index(Request $request): JsonResponse
    {
        $personnes = $this->personneRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PersonneResource::collection($personnes), 'Personnes retrieved successfully');
    }

    /**
     * Store a newly created Personne in storage.
     * POST /personnes
     */
    public function store(CreatePersonneAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $personne = $this->personneRepository->create($input);

        return $this->sendResponse(new PersonneResource($personne), 'Personne saved successfully');
    }

    /**
     * Display the specified Personne.
     * GET|HEAD /personnes/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Personne $personne */
        $personne = $this->personneRepository->find($id);

        if (empty($personne)) {
            return $this->sendError('Personne not found');
        }

        return $this->sendResponse(new PersonneResource($personne), 'Personne retrieved successfully');
    }

    /**
     * Update the specified Personne in storage.
     * PUT/PATCH /personnes/{id}
     */
    public function update($id, UpdatePersonneAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Personne $personne */
        $personne = $this->personneRepository->find($id);

        if (empty($personne)) {
            return $this->sendError('Personne not found');
        }

        $personne = $this->personneRepository->update($input, $id);

        return $this->sendResponse(new PersonneResource($personne), 'Personne updated successfully');
    }

    /**
     * Remove the specified Personne from storage.
     * DELETE /personnes/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Personne $personne */
        $personne = $this->personneRepository->find($id);

        if (empty($personne)) {
            return $this->sendError('Personne not found');
        }

        $personne->delete();

        return $this->sendSuccess('Personne deleted successfully');
    }
}
