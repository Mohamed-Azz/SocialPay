<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['employee_id', 'grant_id', 'mandate_id', 'file_path', 'status', 'rejection_reason'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function grant()
    {
        return $this->belongsTo(Grant::class);
    }

    public function mandate()
    {
        return $this->belongsTo(Mandate::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
