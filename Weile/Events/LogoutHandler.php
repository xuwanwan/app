<?php

namespace Weile\Events;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LogoutHandler
{



    public function handle($member)
    {
 #       var_dump($member);
        if($member) {
            if ($member->last_attempt_at == '') {
                $last_attempt_at = new Carbon;
            } else {
                $last_attempt_at = new Carbon($member->last_attempt_at);
            }

            if ($last_attempt_at->isToday()) {
                //当天不更新加积分字段
            } elseif ($last_attempt_at->isPast()) {
                $member->login = 0;
            }
            $member->last_attempt_at = new Carbon;
            $member->save();
        }
    }



}
