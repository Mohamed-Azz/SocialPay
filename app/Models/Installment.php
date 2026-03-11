<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = ['payment_id', 'amount', 'due_date', 'is_paid', 'paid_at'];
}
