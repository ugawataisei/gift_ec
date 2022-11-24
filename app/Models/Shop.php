<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'name',
        'information',
        'file_name',
        'is_selling',
    ];

    //relation
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
