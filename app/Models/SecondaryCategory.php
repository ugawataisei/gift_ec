<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecondaryCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'primary_category_id',
        'name',
        'sort_order',
    ];

    //relation
    public function owner(): BelongsTo
    {
        return $this->belongsTo(PrimaryCategory::class);
    }
}
