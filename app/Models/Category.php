<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function tshirtImagesRef(): HasMany
    {
        return $this->hasMany(TshirtImage::class, 'category_id', 'id');
    }
}
