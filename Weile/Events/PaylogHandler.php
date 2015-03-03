<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/2
 * Time: 下午9:22
 */

namespace Weile\Events;


use Paylog;

class PaylogHandler {

    public function handle($member, $msg, $val)
    {
#        var_dump($member->toArray());
#        var_dump($type);
        Paylog::create(['member_id'=>$member->id, 'message'=>$msg, 'value'=>$val]);
    }

}