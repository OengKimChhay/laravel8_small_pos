<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'customer_id',
        'user_id',
        'paid_amount',
        'balance',
        'payment_method',
        'transactoin_amount'
    ];
    function Order_detail(){
        return $this->BelongsTo(Order_Detail::class);
    }
}
