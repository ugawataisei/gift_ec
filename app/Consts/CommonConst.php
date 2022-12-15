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

    const SELLING_OPTION = [
        self::SELLING_DISCONTINUED => self::MB_SELLING_DISCONTINUED,
        self::SELLING_NOW => self::MB_SELLING_NOW,
    ];
}
