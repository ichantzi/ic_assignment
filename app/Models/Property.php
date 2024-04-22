<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    use HasFactory;

    public int $user_id;
    public int $price;
    public int $code;
    public int $location_id;
    public int $availability_type;
    public int $area_sq;
    protected $fillable = ['price', 'location_id', 'availability_type', 'area_sq', 'user_id', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
