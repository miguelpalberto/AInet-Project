<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\TshirtImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = ['nif', 'address', 'default_payment_type', 'default_payment_ref'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tshirtImages(): HasMany
    {
        return $this->hasMany(TshirtImage::class, 'customer_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
