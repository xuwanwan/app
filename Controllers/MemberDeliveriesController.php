<?php
namespace Controllers;

use Weile\District;
use Weile\Repositories\MemberRepositoryInterface;

class MemberDeliveriesController extends BaseController {
    protected $members;

    public function __construct(MemberRepositoryInterface $member) {
        $this->beforeFilter('auth');
        $this->members = $member;
        $this->member = \Auth::user();
        parent::__construct();
    }
	/**
	 * Display a listing of the resource.
	 * GET /memberdeliveries
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $data =  $this->member->delivery;
        $this->view('member.delivery-show', compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /memberdeliveries/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $form_data = (new District())->provinceSelect();
        $this->view('member.delivery-create', compact('form_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /memberdeliveries
	 *
	 * @return Response
	 */
	public function store()
	{
        $form = $this->members->getMemberDeliveryForm();
        if (!$form->isValid()) {
            return $this->redirectBack(['error'=> $form->getErrors()]);
        }

        $this->members->createDelivery($this->member,\Input::all());
        return 'success';
	}

	/**
	 * Display the specified resource.
	 * GET /memberdeliveries/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        $data = $this->member->delivery->find($id);
        return $data;
        $this->view('member.delivery-show', compact('data'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /memberdeliveries/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $form_data = (new District())->provinceSelect();
        $delivery = $this->member->delivery()->find($id);
        $this->view('member.delivery-edit', compact('form_data', 'delivery'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /memberdeliveries/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $form = $this->members->getMemberDeliveryForm();
        if (!$form->isValid()) {
            return $this->redirectBack(['error'=> $form->getErrors()]);
        }

        $this->members->updateDelivery($this->member, $id,\Input::all());

        return $this->redirectRoute('member.delivery.edit',['id'=>$id],['success'=>'update success']);
	}

    public function setDefault($id) {
        $this->member->delivery()->update(['default'=>0]);

        $this->member->delivery()->where('id','=', $id)->update(['default'=>1]);

        return $this->redirectRoute('member.delivery.index',[], ['success'=>'success']);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /memberdeliveries/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $de = $this->member->delivery->find($id);
        $de->delete();
        return $this->redirectRoute('member.delivery.index', [], ['success'=>'delete success']);
	}

}