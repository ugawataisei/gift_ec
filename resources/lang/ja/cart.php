<?php


return [
    'title' => 'カート',
    'stripe_title' => 'Stripe決済ページ',
    'stripe_redirect_message' => '決済ページへリダイレクトします。',
    'attribute_labels' => [
        'id' => 'ID',
        'user_id' => '顧客ID',
        'product_id' => '商品ID',
        'quantity' => '数量',
        'created_at' => '作成日',
        'updated_at' => '更新日',
    ],
    'success_message' => [
        'store' => '商品をカートに入れました。',
        'destroy' => 'カートから商品を削除しました。',
        'checkout' => '商品を購入しました。'
    ],
    'error_message' => [
        'destroy' => '削除対象のデータが存在しません。',
        'cancel' => '決済処理に失敗しました。',
        'stock_shortage' => '対象商品の購入数を確認してください。',
    ],
    'view' => [
        'operation' => '操作',
        'total_price' => '合計金額',
        'checkout' => '購入する',
        'tax' => '税込（円）',
    ]
];
