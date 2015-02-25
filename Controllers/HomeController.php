<?php
namespace Controllers;

use Weile\District;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
        $s = '<p>test</p>

<p><img alt="" src="/kcfinder-3.12/upload/images/IMG_0724(1).PNG" style="height:210px; width:140px" /></p>

<p><img alt="" src="/kcfinder-3.12/upload/images/IMG_0724(2).PNG" style="height:210px; width:140px" /><img src="testl"></p>
';

        preg_match_all('#<img.*src="(.*)"[^>]*>#Uis', $s, $m);
        var_dump($m[1]);
		return 'hello';
	}

}
