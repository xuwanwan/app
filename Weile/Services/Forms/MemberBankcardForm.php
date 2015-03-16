<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/24
 * Time: 下午12:15
 */

namespace Weile\Services\Forms;


class MemberBankcardForm extends AbstractForm {

    protected $rules = [
        'bank_id' => 'required',
        'card_number' => 'required',
        'username' => 'required',
        'district' => 'required',
        'district_detail' => 'required',
    ];
}