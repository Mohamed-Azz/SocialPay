<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mandate extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'budget', 'is_active'];
}
