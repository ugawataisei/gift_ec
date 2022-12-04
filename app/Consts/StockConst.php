<?php

namespace App\Consts;

class StockConst
{
    const STOCK_REDUCE = 0;
    const STOCK_ADD = 1;

    const MB_STOCK_REDUCE = '出庫';
    const MB_STOCK_ADD = '入庫';

    const STOCK_OPTION = [
        self::STOCK_REDUCE => self::MB_STOCK_REDUCE,
        self::STOCK_ADD => self::MB_STOCK_ADD,
    ];
}
