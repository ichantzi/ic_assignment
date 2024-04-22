<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface PropertyRepositoryInterface
{
    public function getUserProperties(): Collection;

    public function deleteUserPropertyBy(int $id): int;

    public function createUserProperty(int $price, int $location, int $availability_type, int $area_sq): void;
}
