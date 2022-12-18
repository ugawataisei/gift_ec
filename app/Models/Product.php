<?php

namespace App\Models;

use App\Consts\CommonConst;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $secondary_category_id
 * @property int $image_first
 * @property int $image_second
 * @property int $image_third
 * @property int $image_fourth
 * @property string $name
 * @property string $information
 * @property int $price
 * @property bool $is_selling
 * @property int $sort_order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Shop|null $shop
 * @property SecondaryCategory|null $secondary_category
 * @property Image|null $image_first_relation
 * @property Image|null $image_second_relation
 * @property Image|null $image_third_relation
 * @property Image|null $image_fourth_relation
 * @property Stock|null $stocks
 * @property User|null $users
 * @property Cart|null $pivot
 */
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

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * comment
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id')
            ->withPivot('user_id', 'product_id', 'quantity');
    }

    //public function

    /**
     * 在庫数の合計返却
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return Stock::query()
            ->where('product_id', $this->id)
            ->sum('quantity');
    }

    /**
     *
     * @param Builder $query
     * @param int $categoryId
     * @param Request $request
     * @return Builder
     */
    public function scopeSelectCategory(Builder $query, int $categoryId, Request $request): Builder
    {
        if ($request->has('category_id')) {
            return $query->where('secondary_category_id', $categoryId);
        } else {
            return $query;
        }
    }

    /**
     *
     * @param Builder $query
     * @param int $orderId
     * @param Request $request
     * @return Builder
     */
    public function scopeSortOrder(Builder $query, int $orderId, Request $request): Builder
    {
        if ($request->has('order_id')) {
            return match ($orderId) {
                CommonConst::ORDER_HEIGHT => $query->orderby('price', 'desc'),
                CommonConst::ORDER_LOW => $query->orderby('price', 'asc'),
                CommonConst::ORDER_RECENT => $query->orderby('created_at', 'desc'),
                CommonConst::ORDER_OLDEST => $query->orderby('created_at', 'asc'),
                default => $query->orderby('sort_order', 'asc'), //お気に入り含む
            };
        } else {
            return $query;
        }
    }

    /**
     *
     * @param Builder $query
     * @param string|null $search_keyword
     * @param Request $request
     * @return Builder
     */
    public function scopeSearchKeyword(Builder $query, string|null $search_keyword, Request $request): Builder
    {
        if ($request->has('search_keyword')) {
            $spaceConvert = mb_convert_kana($search_keyword, 's');
            $keywords = preg_split('/\s+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($keywords as $word) {
                $query->where('products.name', 'like', '%' . $word . '%');
            }
            return $query;
        } else {
            return $query;
        }
    }
}
