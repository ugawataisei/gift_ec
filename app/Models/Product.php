<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shop_id',
        'secondary_category_id',
        'image_first',
        'image_second',
        'image_third',
        'image_forth',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
    ];

    //relation
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function secondary_category(): BelongsTo
    {
        return $this->belongsTo(SecondaryCategory::class);
    }

    public function image_first(): HasOne
    {
        return $this->hasOne(Image::class, 'image_first');
    }

    public function image_second(): HasOne
    {
        return $this->hasOne(Image::class, 'image_second');
    }

    public function image_third(): HasOne
    {
        return $this->hasOne(Image::class, 'image_third');
    }

    public function image_forth(): HasOne
    {
        return $this->hasOne(Image::class, 'image_first');
    }
}
