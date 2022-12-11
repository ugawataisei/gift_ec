<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User|null $user
 * @property Product|null $product
 */
class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /** relation */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /** public functions */

    /**
     * 購入数と値段で合計金額を取得
     *
     * @return int
     */
    public function getTotalPrice(): int
    {
        /** @var Product $product */
        $product = Product::query()
            ->where('id', $this->product_id)
            ->first();

        return $this->quantity * $product->price;
    }

    /**
     * カートの合計金額返却
     *
     * @return int
     */
    public static function getCartPrice(): int
    {
        /** @var Collection $carts */
        $carts = Cart::query()
            ->where('user_id', Auth::id())
            ->get();

        $cartPrice = 0;
        foreach ($carts as $cart) {
            /** @var Cart $cart */
            $cartPrice += $cart->getTotalPrice();
        }

        return $cartPrice;
    }
}
