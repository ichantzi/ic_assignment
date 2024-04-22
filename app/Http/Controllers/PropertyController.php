<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Interfaces\Repositories\PropertyRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PropertyController extends Controller
{
    protected PropertyRepositoryInterface $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository) {
        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        $properties = $this->propertyRepository->getUserProperties();
        return Inertia::render('Dashboard', [
            'properties' => $properties,
        ]);
    }

    public function store(StorePropertyRequest $request) : \Illuminate\Http\JsonResponse
    {
        try {
            $this->propertyRepository->createUserProperty(request('price'), request('location'), request('availability_type'), request('area_sq'));

            $properties = $this->propertyRepository->getUserProperties();
            return response()->json(['message' => 'Property created successfully','properties' => $properties], 201);
        } catch(\Exception $exception) {
            Log::error($exception->getTraceAsString());
            $properties = $this->propertyRepository->getUserProperties();
            return response()->json(['message' => 'Something went wrong','properties' => $properties], 200);
        }

    }

    public function destroy(int $id) : \Illuminate\Http\JsonResponse
    {
        if ($this->propertyRepository->deleteUserPropertyBy($id)) {
            return response()->json(['message' => 'Property deleted successfully']);
        }

        return response()->json(['message' => 'Deletion Failed']);
    }

}
