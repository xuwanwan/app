<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/24
 * Time: 下午12:15
 */

namespace Weile\Services\Forms;


class MemberDeliveryForm extends AbstractForm {

    protected $rules = [
        'username' => 'required',
        'phone' => 'required|digits:11',
        'district' => 'required',
        'detail' => 'required',
    ];
}