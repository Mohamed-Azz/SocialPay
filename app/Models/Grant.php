<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    protected $fillable = ['bab_id', 'name', 'amount', 'conditions', 'required_documents', 'repayment_percentage', 'installments_count'];

    public function bab()
    {
        return $this->belongsTo(Bab::class);
    }
}
