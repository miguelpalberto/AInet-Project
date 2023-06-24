<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'code';//dizer chave prim nao e id, é code
    protected $keyType = 'string';//dizer tipostring  dados chave primaria
    public $incrementing = false;

    public function orderItemsCol(): HasMany
    {

        return $this->hasMany(OrderItem::class, 'color_code', 'code');
    }

    protected function fullColorUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->code ? asset('storage/tshirt_base/' . $this->code.'.jpg') :
                    asset('img/image_unknown.png');
            },
        );
    }

}
