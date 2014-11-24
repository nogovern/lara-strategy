<?php namespace Acme\Payment;

class PaymentByCreditCard implements PaymentInterface {

	protected $service_id;

	public function __construct()
	{
		$this->service_id = \Config::get('site.pg.virtual.service_id');
	}

	public function getServiceId()
	{
		return $this->service_id;
	}
	
	public function create($data= array())
	{

	}

	public function request($data = array())
	{
		var_dump('신용카드 결제를 요청합니다');

		// dbpath 로 결제 결과를 받음 - pay/cc/redirpath

		// redirpath 로 결과 페이지로 전환 - pay/cc/redirpath

		// 전환전 결제창 닫음
		    
		// 결과페이로 이동
	}

	public function cancel($payment_id)
	{
		var_dump('신용카드 결제를 취소합니다');
	}

	public function dbpath()
	{
		dd('dbpath');
	}

	public function redirpath()
	{
		dd('redirpath');
	}
}