<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    public function property(){
        return $this->hasOne(Property::class);
    }
}
