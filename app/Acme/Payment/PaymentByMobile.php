<?php namespace Acme\Payment;

class PaymentByMobile implements PaymentInterface {

	private $service_id;

	public function __construct()
	{	
		$this->service_id = \Config::get('site.pg.mobile.service_id');
	}

	public function getServiceId()
	{
		return $this->service_id;
	}
	
	public function request($data = array())
	{
		var_dump('핸드폰 결제를 요청합니다');
	}

	public function create($data= array())
	{

	}

	public function cancel($payment_id)
	{
		var_dump('핸드폰 결제를 취소합니다');
	}
}