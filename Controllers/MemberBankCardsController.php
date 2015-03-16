<?php

namespace Controllers;

use Weile\District;
use Weile\OrderedTreeDistrict;
use Weile\Repositories\MemberRepositoryInterface;

class MemberBankCardsController extends BaseController {

    protected $members;

    public function __construct(MemberRepositoryInterface $member) {
        $this->beforeFilter('auth');
        $this->members = $member;
        $this->member = \Auth::user();
        parent::__construct();
    }
	/**
	 * Display a listing of the resource.
	 * GET /memberbankcards
	 *
	 * @return Response
	 */
	public function index()
	{
        return ['type'=>1, 'msg'=>'success'];
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /memberbankcards/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /memberbankcards
	 *
	 * @return Response
	 */
	public function store()
	{
        $form = $this->members->getMemberBankcardForm();
        if (!$form->isValid()) {
            return ['type'=>0, 'msg'=>$form->getErrors()->toArray()];
        }

        $this->members->createBankcard($this->member,\Input::all());
        return ['type'=>1, 'msg'=>'success'];
	}

	/**
	 * Display the specified resource.
	 * GET /memberbankcards/{id}
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
	 * GET /memberbankcards/{id}/edit
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
	 * PUT /memberbankcards/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $form = $this->members->getMemberBankcardForm();
        if (!$form->isValid()) {
            return ['type'=>0, 'msg'=>$form->getErrors()->toArray()];
        }

        $this->members->updateBankcard($this->member, $id,\Input::all());
        return ['type'=>1, 'msg'=>'success'];
	}

    public function setDefault($id) {
        $this->member->bankcard()->update(['default'=>0]);

        $this->member->bankcard()->where('id','=', $id)->update(['default'=>1]);

        return ['type'=>1, 'msg'=>'success'];
    }
	/**
	 * Remove the specified resource from storage.
	 * DELETE /memberbankcards/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}