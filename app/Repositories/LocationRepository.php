<?php

namespace App\Repositories;

use App\Interfaces\Repositories\LocationRepositoryInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface

{

    public function getLocations(): Collection
    {
        return Location::all();
    }


}
