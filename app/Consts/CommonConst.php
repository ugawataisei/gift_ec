<?php

namespace App\Consts;

class CommonConst
{
    const REDIRECT_STATUS_INFO = 'info';
    const REDIRECT_STATUS_ALERT = 'alert';

    const SELLING_DISCONTINUED = 0;
    const SELLING_NOW = 1;

    const MB_SELLING_DISCONTINUED = '販売停止';
    const MB_SELLING_NOW = '販売中';

    const IMAGE_SHOP_PATH = 'public/images/shops/';
    const IMAGE_PRODUCT_PATH = 'public/images/products/';

    const ORDER_RECOMMENDED = 1;
    const ORDER_HEIGHT = 2;
    const ORDER_LOW = 3;
    const ORDER_RECENT = 4;
    const ORDER_OLDEST = 5;

    const ORDER_OPTION = [
        self::ORDER_RECOMMENDED => 'おすすめ順',
        self::ORDER_HEIGHT => '高い順',
        self::ORDER_LOW => '安い順',
        self::ORDER_RECENT => '新しい順',
        self::ORDER_OLDEST => '古い順',
    ];

    const SELLING_OPTION = [
        self::SELLING_DISCONTINUED => self::MB_SELLING_DISCONTINUED,
        self::SELLING_NOW => self::MB_SELLING_NOW,
    ];
}
