<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    public function getLocations(): Collection;

}
