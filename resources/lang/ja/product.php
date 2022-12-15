<?php

return [
    'title' => '商品一覧',
    'attribute_labels' => [
        'id' => 'ID',
        'shop_id' => '店舗ID',
        'secondary_category_id' => '第二カテゴリーID',
        'image_first' => '写真１',
        'image_second' => '写真2',
        'image_third' => '写真3',
        'image_fourth' => '写真4',
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
];
