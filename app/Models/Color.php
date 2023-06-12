<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function orderItemsCol(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'color_code', 'code');
    }
}
