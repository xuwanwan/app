<?php
namespace Controllers;
use Weile\OrderedTreeDistrict;
use Weile\Repositories\MemberRepositoryInterface;

class OrdersController extends BaseController {

    protected $members;
    protected $member;

    public function __construct(MemberRepositoryInterface $members) {

        $this->beforeFilter('auth');

        $this->members = $members;
        $this->member = \Auth::user();

        parent::__construct();
    }
	/**
	 * Display a listing of the resource.
	 * GET /orders
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $orders = $this->member->orders;
//        var_dump($orders);
        $orders = $orders->each(function($order) {
#            var_dump($order->products->toArray());
            foreach($order->products as $v) {
#                var_dump($v->pivot->num);
            }
        });
#        var_dump($orders->toArray());
        $this->view('orders.list', compact('orders'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /orders/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /orders
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        $order = \ProductOrder::with('products')->find($id);
#        var_dump($order->toArray());
        $district_path = OrderedTreeDistrict::getPathById($order->district);
        $this->view('orders.show', compact('order', 'district_path'));

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /orders/{id}/edit
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
	 * PUT /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /orders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
#        var_dump($id);
        $order = \ProductOrder::find($id);
        //软删除
        $order->delete();
        //强制删除
#        $order->forceDelete();
#        $order->products()->detach(7);


        return \Redirect::back()->with(['success'=>'success!']);

	}

}