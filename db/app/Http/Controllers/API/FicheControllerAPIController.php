<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFicheControllerAPIRequest;
use App\Http\Requests\API\UpdateFicheControllerAPIRequest;
use App\Http\Resources\FicheResource;
use App\Models\FicheController;
use App\Repositories\FicheRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FicheControllerResource;

/**
 * Class FicheControllerAPIController
 */
class FicheControllerAPIController extends AppBaseController
{
    /** @var  FicheRepository */
    private $ficheControllerRepository;

    public function __construct(FicheRepository $ficheControllerRepo)
    {
        $this->ficheControllerRepository = $ficheControllerRepo;
    }

    /**
     * Display a listing of the FicheControllers.
     * GET|HEAD /fiche-controllers
     */
    public function index(Request $request): JsonResponse
    {
        $ficheControllers = $this->ficheControllerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FicheResource::collection($ficheControllers), 'Fiche Controllers retrieved successfully');
    }

    /**
     * Store a newly created FicheController in storage.
     * POST /fiche-controllers
     */
    public function store(CreateFicheControllerAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $ficheController = $this->ficheControllerRepository->create($input);

        return $this->sendResponse(new FicheControllerResource($ficheController), 'Fiche Controller saved successfully');
    }

    /**
     * Display the specified FicheController.
     * GET|HEAD /fiche-controllers/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var FicheController $ficheController */
        $ficheController = $this->ficheControllerRepository->find($id);

        if (empty($ficheController)) {
            return $this->sendError('Fiche Controller not found');
        }

        return $this->sendResponse(new FicheControllerResource($ficheController), 'Fiche Controller retrieved successfully');
    }

    /**
     * Update the specified FicheController in storage.
     * PUT/PATCH /fiche-controllers/{id}
     */
    public function update($id, UpdateFicheControllerAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var FicheController $ficheController */
        $ficheController = $this->ficheControllerRepository->find($id);

        if (empty($ficheController)) {
            return $this->sendError('Fiche Controller not found');
        }

        $ficheController = $this->ficheControllerRepository->update($input, $id);

        return $this->sendResponse(new FicheControllerResource($ficheController), 'FicheController updated successfully');
    }

    /**
     * Remove the specified FicheController from storage.
     * DELETE /fiche-controllers/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var FicheController $ficheController */
        $ficheController = $this->ficheControllerRepository->find($id);

        if (empty($ficheController)) {
            return $this->sendError('Fiche Controller not found');
        }

        $ficheController->delete();

        return $this->sendSuccess('Fiche Controller deleted successfully');
    }
}
