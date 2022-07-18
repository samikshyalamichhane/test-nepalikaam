<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboards';
    protected $fillable = [
        'facebook', 'twitter', 'address', 'phone', 'email', 'youtube', 'instagram', 'mission', 'advertisement', 'map', 'rate', 'notice','news_feed', 'password', 'whatsapp', 'bank__details', 'notification', 'submit__transaction', 'registerTemplate', 'transactionTemplate', 'newTransactionSubject', 'service_charge', 'discounted_amount', 'promo_code', 'transaction_limit_bank_deposit', 'transaction_limit_remit', 'transaction_limit_esewa',
    ];
}
