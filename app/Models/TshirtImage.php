<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasMany;

class TshirtImage extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'category_id', 'name', 'description', 'image_url', 'extra_info'];
    protected $dates = ['deleted_at'];

    public function categoryRef(): BelongsTo
    {
        //FK, PK
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function customerRef(): BelongsTo
    {
        //FK, PK
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    //NAO HA FK NA TSHIRTIMAGE PARA A ORDERITEMS
    // public function orderItemsT(): HasMany
    // {
    //     return $this->hasMany(OrderItem::class, 'order_item_id', 'id');
    // }


    //     //TODO: fazer apaecer antes diretamente pelo nome da categoria (caso este mude por exemplo)
    // protected function categoryStr(): Attribute
    // {
    //     return Attribute::make(
    //         get: function () {
    //             if ($this->category_id == '1') {
    //                 return 'Funny';
    //             } elseif ($this->category_id == '2') {
    //                 return 'Geeks';
    //             } elseif ($this->category_id == '3') {
    //                 return 'Memes';
    //             } elseif ($this->category_id == '4') {
    //                 return 'Inspiration';
    //             } elseif ($this->category_id == '5') {
    //                 return 'Plain';
    //             } elseif ($this->category_id == '6') {
    //                 return 'Movies';
    //             } elseif ($this->category_id == '7') {
    //                 return 'Music';
    //             } elseif ($this->category_id == '8') {
    //                 return 'Places';
    //             } elseif ($this->category_id == '9') {
    //                 return 'Logos';
    //             } elseif ($this->category_id == '10') {
    //                 return 'Advertising and brands';
    //             } elseif ($this->category_id == '11') {
    //                 return 'Abtract Drawings';
    //             } elseif ($this->category_id == '12') {
    //                 return 'Drinks';
    //             } elseif ($this->category_id == '13') {
    //                 return 'Meaningless';
    //             } elseif ($this->category_id == '14') {
    //                 return 'Childish';
    //             } elseif ($this->category_id == '15') {
    //                 return 'Sports';
    //             } elseif ($this->category_id == '16') {
    //                 return 'Summer';
    //             } elseif ($this->category_id == '17') {
    //                 return 'Surf';
    //             } elseif ($this->category_id == '18') {
    //                 return 'Tattoo';
    //             } elseif ($this->category_id == '19') {
    //                 return 'Vintage';
    //             } elseif ($this->category_id == '20') {
    //                 return 'Cool';
    //             } elseif ($this->category_id == '21') {
    //                 return 'Phrases';
    //             } else {
    //                 return $this->category_id;
    //             }
    //         },
    //     );
    // }


}
