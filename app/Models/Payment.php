<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['request_id', 'user_id', 'reference_number', 'amount', 'bank_fees', 'payment_date'];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
