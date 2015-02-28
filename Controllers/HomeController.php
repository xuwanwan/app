<?php
namespace Controllers;

use Baum\Node;
use Illuminate\Database\Eloquent\Collection;
use Weile\District;
use Weile\OrderedTreeDistrict;

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

#        $node = District::find(1)->children();
##        var_dump($node->get()->toArray());


#        $node = District::select('name')->getParent(533);
#        $node = District::find(37)->getParentNode();
#        $node = District::ancestors(533);

        $node = OrderedTreeDistrict::find(1);
        $sub = $node->getDescendantsAndSelf()->lists('name', 'id');
        var_dump($sub);

#        var_dump(count($node));
#        var_dump($node->toArray());

        var_dump(\DB::getQueryLog());
		return 'hello';
	}




}
