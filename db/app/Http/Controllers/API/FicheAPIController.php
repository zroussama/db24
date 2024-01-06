<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFicheAPIRequest;
use App\Http\Requests\API\UpdateFicheAPIRequest;
use App\Models\Fiche;
use App\Repositories\FicheRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FicheResource;

/**
 * Class FicheAPIController
 */
class FicheAPIController extends AppBaseController
{
    /** @var  FicheRepository */
    private $ficheRepository;

    public function __construct(FicheRepository $ficheRepo)
    {
        $this->ficheRepository = $ficheRepo;
    }

    /**
     * Display a listing of the Fiches.
     * GET|HEAD /fiches
     */
    public function index(Request $request): JsonResponse
    {
        $fiches = $this->ficheRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FicheResource::collection($fiches), 'Fiches retrieved successfully');
    }

    /**
     * Store a newly created Fiche in storage.
     * POST /fiches
     */
    public function store(CreateFicheAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $fiche = $this->ficheRepository->create($input);

        $fiche = Fiche::create($request->all());

        // Create gerant contact
        $fiche->contacts()->create([
            'fonction' => 'gerant',
            // other contact attributes
        ]);


        return $this->sendResponse(new FicheResource($fiche), 'Fiche saved successfully');
    }

    /**
     * Display the specified Fiche.
     * GET|HEAD /fiches/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Fiche $fiche */
        $fiche = $this->ficheRepository->find($id);

        if (empty($fiche)) {
            return $this->sendError('Fiche not found');
        }

        return $this->sendResponse(new FicheResource($fiche), 'Fiche retrieved successfully');
    }

    /**
     * Update the specified Fiche in storage.
     * PUT/PATCH /fiches/{id}
     */
    public function update($id, UpdateFicheAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Fiche $fiche */
        $fiche = $this->ficheRepository->find($id);

        if (empty($fiche)) {
            return $this->sendError('Fiche not found');
        }

        $fiche = $this->ficheRepository->update($input, $id);

        return $this->sendResponse(new FicheResource($fiche), 'Fiche updated successfully');
    }

    /**
     * Remove the specified Fiche from storage.
     * DELETE /fiches/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Fiche $fiche */
        $fiche = $this->ficheRepository->find($id);

        if (empty($fiche)) {
            return $this->sendError('Fiche not found');
        }

        $fiche->delete();

        return $this->sendSuccess('Fiche deleted successfully');
    }
}
