<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    public function property(){
        return $this->hasMany(Property::class);
    }
}
