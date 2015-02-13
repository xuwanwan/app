<?php

namespace Weile\Events;
use Illuminate\Support\Facades\Log;

class LoginHandler
{


    public function handle($member)
    {
        $this->addScore($member);
    }

    protected function addScore($member) {
        //判断当天登录
        if($member->login == 0) {
            $member->score += 5;
            $member->login = 1;
        }
        $score = $member->score;
        if ($score % 100 == 0) {
            $member->level += 1;
        }
        $member->save();

    }


}
