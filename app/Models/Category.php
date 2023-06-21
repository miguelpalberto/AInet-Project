<?php

namespace App\Models;

use App\Models\TshirtImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function tshirtImagesRef(): HasMany
    {
        return $this->hasMany(TshirtImage::class, 'category_id', 'id');
    }
}
