<?php

return [
    'title' => '商品一覧',
    'edit_title' => '商品編集',
    'create_title' => '商品登録',
    'attribute_labels' => [
        'id' => 'ID',
        'shop_id' => '店舗ID',
        'secondary_category_id' => '第二カテゴリーID',
        'image_first' => '商品画像１',
        'image_second' => '商品画像2',
        'image_third' => '商品画像3',
        'image_fourth' => '商品画像4',
        'name' => '商品名',
        'information' => '商品情報',
        'price' => '値段',
        'is_selling' => '販売状況',
        'sort_order' => '順番',
        'created_at' => '作成日',
        'updated_at' => '更新日',
    ],
    'success_message' => [
        'store' => '商品登録が完了しました。',
        'update' => '商品情報を更新しました。',
        'destroy' => '登録商品を削除しました。',
        'stock' => '在庫情報が変更されています。ご確認ください。',
    ],
    'error_message' => [
        'destroy' => '削除対象のデータが存在しません。'
    ],
    'view' => [
        'quantity' => '数量',
        'in_cart' => 'カート',
        'select_image' => '※商品画像1で設定したものがTopとして表示されます',
        'alert_amount' => '※数量は0~99の間で設定してください',
    ]
];
