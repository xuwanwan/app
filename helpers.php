<?php

function build_order_no()
{
    /* 选择一个随机的方案 */
    mt_srand((double) microtime() * 1000000);
 
    return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

function percent_div($int) {
    return bcdiv($int, 100, 2);
}

function income_mul($a, $b) {
    return bcmul($a, $b, 3);
}
function income_add($a, $b) {
    return bcadd($a, $b, 3);
}
