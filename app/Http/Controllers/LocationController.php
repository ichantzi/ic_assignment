<?php

namespace App\Http\Controllers;

use App\Interfaces\Repositories\LocationRepositoryInterface;
use Inertia\Inertia;

class LocationController extends Controller
{
    protected LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository) {
        $this->locationRepository = $locationRepository;
    }

    public function index()
    {
        $locations = $this->locationRepository->getLocations();
        return response()->json(['locations' => $locations], 200);

    }
}
