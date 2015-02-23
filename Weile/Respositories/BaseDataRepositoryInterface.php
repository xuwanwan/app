<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/23
 * Time: 下午10:30
 */

namespace Weile\Repositories;


interface BaseDataRepositoryInterface
{
    public function getMemberDetailFormOptions();

    public function getMemberDetailFormSexOption();

    public function getMemberDetailFormEducationOption();

    public function getMemberDetailFormHouseOption();

    public function getMemberDetailFormMarriageStatusOption();

    public function getMemberDetailFormMonthlyIncomeOption();

    public function getMemberDetailFormPositionOption();

    public function getMemberDetailFormProfessionOption();

    public function getMemberDetailFormTrafficOption();

    public function getProvince();

    public function getSubDistrict($id);

}
