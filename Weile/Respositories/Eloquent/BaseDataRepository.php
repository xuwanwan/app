<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/23
 * Time: 下午10:40
 */

namespace Weile\Repositories\Eloquent;


use Weile\District;
use Illuminate\Support\Facades\DB;
use Weile\Repositories\BaseDataRepositoryInterface;


class BaseDataRepository extends AbstractRepository implements BaseDataRepositoryInterface{

    public function __construct() {

    }

    public function getMemberDetailFormOptions() {

        $select_now_district = $this->getProvince();
        $select_birth_district = $select_now_district;
        $select_sex = $this->getMemberDetailFormSexOption();
        $select_education = $this->getMemberDetailFormEducationOption();
        $select_house = $this->getMemberDetailFormHouseOption();
        $select_marriage_status = $this->getMemberDetailFormMarriageStatusOption();
        $select_monthly_income = $this->getMemberDetailFormMonthlyIncomeOption();
        $select_position = $this->getMemberDetailFormPositionOption();
        $select_profession = $this->getMemberDetailFormProfessionOption();
        $select_traffic = $this->getMemberDetailFormTrafficOption();
        $data = compact('select_sex',
            'select_now_district',
            'select_birth_district',
            'select_education',
            'select_house',
            'select_marriage_status',
            'select_monthly_income',
            'select_position',
            'select_profession',
            'select_traffic');
        return $data;
    }

    public function getMemberDetailFormSexOption() {
       return DB::table('select_sex')->lists('description', 'id');
    }

    public function getMemberDetailFormEducationOption() {
       return DB::table('select_education')->lists('description', 'id');
    }

    public function getMemberDetailFormHouseOption() {
        return DB::table('select_house')->lists('description', 'id');
    }

    public function getMemberDetailFormMarriageStatusOption() {
        return DB::table('select_marriage_status')->lists('description', 'id');
    }

    public function getMemberDetailFormMonthlyIncomeOption() {
        return DB::table('select_monthly_income')->lists('description', 'id');
    }

    public function getMemberDetailFormPositionOption() {
        return DB::table('select_position')->lists('description', 'id');
    }

    public function getMemberDetailFormProfessionOption() {
        return DB::table('select_profession')->lists('description', 'id');
    }

    public function getMemberDetailFormTrafficOption() {
        return DB::table('select_traffic')->lists('description', 'id');
    }

    public function getProvince() {
        return DB::table('district')->where('parentid', '=','0')->lists('name', 'id');
    }

    public function getSubDistrict($id) {
        $district = District::find($id);
        $data = $district->children()->lists('name', 'id');
        return $data;
    }
}