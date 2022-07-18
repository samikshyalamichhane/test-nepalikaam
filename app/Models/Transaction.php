<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['type', 'account_holder_name', 'receiver_contact_name', 'bank_name', 'bank_branch', 'account_number', 'full_name', 'receiver_contact_number', 'pick_up_district', 'remit_amount', 'npr', 'transfer_receipt', 'rate', 'status', 'random_token', 'new', 'user_id', 'contact_number', 'receiver__id', 'promo_code', 'esewa_number',];
    protected $table = 'transactions';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function documents()
    {
        return $this->hasMany(Transactiondocuments::class, 'transaction_id');
    }
}
