<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Order;
use App\Models\TshirtImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['order_id', 'tshirt_image_id', 'color_code', 'size', 'qty', 'unit_price', 'sub_total'];

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

    protected function index(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $index = $this->tshirt_image_id . '_' . $this->color_code . '_' . $this->size;
            },
        );
    }


}
