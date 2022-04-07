<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;
    protected $table = 'order__details';
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'unitprice',
        'amount',
        'discount'
    ];
    function product(){
        return $this->BelongsTo(Product::class);
    }
    function transaction(){
        return $this->BelongsTo(Transaction::class);
    }
}
