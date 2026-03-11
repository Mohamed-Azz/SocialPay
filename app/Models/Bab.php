<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    protected $fillable = ['name', 'type'];

    public function grants()
    {
        return $this->hasMany(Grant::class);
    }
}
