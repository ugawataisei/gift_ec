<?php

/** @var string $success_message */
/** @var array $cartInfo */

$ownerEmails = array_column($cartInfo, 'owner_email');
?>
<p>{{ $success_message }}</p><br>
@foreach($cartInfo as $itemInfo)
    <span>********************************************************</span><br>
    <span>購入商品：{{ $itemInfo['product_name'] }}</span><br>
    <span>値段：{{ $itemInfo['product_price'] }}円（税込）</span><br>
    <span>購入数量：{{ $itemInfo['product_quantity'] }}個</span><br>
    <span>********************************************************</span><br>
@endforeach
<span>購入情報に誤りがある場合は以下にお問い合わせください。</span><br>
@foreach($ownerEmails as $email)
    {{ $email }}<br>
@endforeach
