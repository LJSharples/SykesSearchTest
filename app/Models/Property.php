<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    public function location(){
        return $this->hasOne(Location::class, '__pk', '_fk_location');
    }
}
