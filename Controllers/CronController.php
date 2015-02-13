<?php
namespace Controllers;

use Illuminate\Support\Facades\DB;
use Weile\District;


class CronController extends BaseController {


	public function getClearYesterdayFans() {
		DB::table('members')->update(['newfans_yesterday'=>0]);
		var_dump(DB::getQueryLog());
	}
	
	public function getClearIncomeYesterday() {
		DB::table('members')->update(['income_yesterday'=>0]);
		var_dump(DB::getQueryLog());
	}

    public function getDistrict() {
         $data = (new District)->provinceSelect();
         var_dump($data);
#         return $data;
    }

    public function getSubDistrict($id) {
        $district = District::find($id);
        $data = $district->children()->lists('name', 'id');
        var_dump($data);
#        return $data;
    }

}
