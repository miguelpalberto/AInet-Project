<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    public function order(): BelongsTo
    {
        //FK, PK
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function color(): BelongsTo
    {
        //FK, PK
        return $this->belongsTo(Color::class, 'color_code', 'id');
    }

    public function tshirtImage(): BelongsTo
    {
        //FK, PK
        return $this->belongsTo(TshirtImage::class, 'tshirt_image_id', 'id');
    }
}
