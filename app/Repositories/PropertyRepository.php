<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PropertyRepositoryInterface;
use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyRepository implements PropertyRepositoryInterface
{
    public function getUserProperties(): Collection {
        return Property::select('properties.*', 'locations.title as location',
            DB::raw("CASE WHEN properties.availability_type = 1 THEN 'Ενοικίαση' ELSE 'Πώληση' END as availability"))
            ->leftJoin('locations', 'properties.location_id', '=', 'locations.id')
            ->where('properties.user_id', Auth::id())
            ->get();
    }

    public function deleteUserPropertyBy(int $id): int {
        return Property::where('id', $id)
            ->where('user_id', Auth::id())->delete();
    }

    public function createUserProperty(int $price, int $location, int $availability_type, int $area_sq): void {

        Property::query()->create([
            'price' => $price,
            'code' => rand(00000000,99999999),
            'location_id' => $location,
            'availability_type' => $availability_type,
            'area_sq' => $area_sq,
            'user_id' => Auth::id()
        ]);
    }
}
