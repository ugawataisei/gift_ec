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
        'image_fourth',
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

    public function image_first_relation(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_first', 'id');
    }

    public function image_second_relation(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_second', 'id');
    }

    public function image_third_relation(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_third', 'id');
    }

    public function image_fourth_relation(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_fourth', 'id');
    }
}
