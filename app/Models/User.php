<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    function record()
    {
        return $this->hasMany(Record::class);
    }
}
