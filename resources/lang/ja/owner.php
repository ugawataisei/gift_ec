<?php

return [
    'title' => 'オーナー管理',
    'create_title' => 'オーナー登録',
    'edit_title' => 'オーナー編集',
    'expired_title' => '契約切れオーナー管理',
    'attribute_labels' => [
        'id' => 'ID',
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'email_verified_at' => '検証済み',
        'password' => 'パスワード',
        'remember_token' => 'トークン',
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
    'view' => [
        'operation' => '操作',
        'contract_cancellation_date' => '契約解除日',
        'destroy' => '完全に削除',
    ],
];

