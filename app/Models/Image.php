<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $owner_id
 * @property string $file_name
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Owner|null $owner
 */
class Image extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'file_name',
        'title',
    ];

    //relation
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
