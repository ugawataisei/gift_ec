<?php

return [
    'title' => '店舗画像管理',
    'create_title' => '店舗画像登録',
    'edit_title' => '店舗画像編集',
    'attribute_labels' => [
        'id' => 'ID',
        'owner_id' => '店舗オーナーID',
        'file_name' => 'ファイル名',
        'title' => 'タイトル',
        'created_at' => '作成日',
        'updated_at' => '更新日',
    ],
    'success_message' => [
        'store' => '商品画像の登録が完了しました',
        'update' => '画像情報を更新しました',
        'destroy' => '登録画像を削除しました',
    ],
    'error_message' => [
        'not_exist' => '削除対象のデータが存在しません'
    ],
];
