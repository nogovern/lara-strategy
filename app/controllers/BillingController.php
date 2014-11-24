<?php

class BillingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('billings.index');
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
	}

	/**
	 * 핸드폰결제 - notiurl
	 * @return [type] [description]
	 */
	public function mc_callback()
	{
		$isOk = false;
		$input = Input::all();

		// 결제결과 저장
		if(Input::get('Resultcd') == '0000')
		{
			$isOk = true;
		}

		return $isOk ? 'SUCCESS' : 'FAIL';
	}

	/**
	 * 핸드폰결제 - okurl 
	 * -- 결제 결과를 받아 처리한다.
	 * @return [type] [description]
	 */
	public function mc_okurl()
	{
		$payment = new Acme\Payment\PaymentByMobile();
		$result = $payment->response();
	}

	/**
	 * 신용카드 - dbpath
	 * @return [type] [description]
	 */
	public function cc_dbpath()
	{
		$payment = new Acme\Payment\PaymentByCreditCard();
		$payment->dbpath();
	}

	/**
	 * 신용카드 - redirpath
	 * @return [type] [description]
	 */
	public function cc_redirpath()
	{
		$payment = new Acme\Payment\PaymentByCreditCard();
		$payment->redirpath();
	}



	// 테스트용 결제 양식
	public function getMobileForm()
	{
		return View::make('pg_sample.mobile.mc_web_utf8');
	}

	public function postMobileForm()
	{
		return View::make('pg_sample.mobile.okurl_utf8');
	}

	public function getCardForm()
	{
		return View::make('pg_sample.cc.cn_web');
	}

}
