<?php


return [
    'title' => 'カート',
    'attribute' => [
        'quantity' => '数量',
    ],
    'view' => [
        'price_prefix' => '円（税込）',
        'buy_items' => '購入',
        'total' => '合計金額'
    ],
    /** success message */
    'success_message' => [
        'stripe_success' => '決済処理に成功しました。'
    ],
    /** error message */
    'error_message' => [
        'stock_error' => '在庫情報が更新されています。',
        'stripe_cancel' => '決済処理に失敗しました。'
    ],
];
