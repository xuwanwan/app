<?php
namespace Controllers;

use Gloudemans\Shoppingcart\CartCollection;
use Illuminate\Support\Facades\Input;

class ShopCartController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
#        \Cart::destroy();return;
        $contents = \Cart::content()->paginate(5);
//        foreach ($contents as $row) {
////            echo 'You have ' . $row->qty . ' items of ' . $row->product->name . ' with description: "' . $row->product->description . '" in your cart.';
//        }

        $total = number_format(\Cart::total(), 2);
        $this->view('shopcart.index', compact('contents', 'total'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $fields = ['id', 'name', 'price', 'qty'];
        $rules = [
            'id' => 'required|integer',
            'name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer'
        ];
        $data = array_only(Input::all(), $fields);
        $validator = \Validator::make($data, $rules);
#        var_dump($data);exit;

        if ($validator->passes()) {
            \Cart::associate('Product')->add($data);
            return \Redirect::back()->with(['success'=>'添加成功']);
        } else {
            return $this->redirectBack(['error'=>'添加失败']);
        }

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $num = intval(\Input::get('num'));
        $num = $num > 0 ? $num : 0;
        $cartid = \Input::get('cartid');

        \Cart::update($cartid, $num);
        return $this->redirectBack(['success'=>'更新成功']);
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(\Input::has('cartid')) {
            $cartid = \Input::get('cartid');

            \Cart::remove($cartid);
        } else {
            \Cart::destroy();
        }
        return $this->redirectBack(['success'=>'更新成功']);
	}


}
