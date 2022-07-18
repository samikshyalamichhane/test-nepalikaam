<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactiondocuments extends Model
{
    protected $fillable = ['transaction_id', 'document',];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
