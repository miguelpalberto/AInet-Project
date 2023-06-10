<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url'];
    protected $dates = ['date'];


    public function customerRef(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
