<?php
namespace Controllers;


use Weile\OrderedTreeDistrict;
use Weile\Repositories\MemberRepositoryInterface;

class CardOrdersController extends BaseController {

    protected $members;
    protected $member;

    public function __construct(MemberRepositoryInterface $members) {

        parent::__construct();

        $this->beforeFilter('auth');

        $this->members = $members;
        $this->member = \Auth::user();

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
        $orders = $this->member->cardorders()->recent()->get();
#        var_dump($orders);
#        var_dump($orders->toArray());
        foreach($orders as $v) {
            var_dump($v->cardvips->first()->toArray());
            var_dump($v->cardcoupons->first());
            break;
        }
        $this->view('orders.cardlist', compact('orders'));
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /cardorders/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cardorders
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /cardorders/{id}
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
	 * GET /cardorders/{id}/edit
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
	 * PUT /cardorders/{id}
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
	 * DELETE /cardorders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}