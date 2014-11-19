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
	
	public function request($data = array())
	{
		var_dump('신용카드 결제를 요청합니다');
	}

	public function create($data= array())
	{

	}

	public function cancel($payment_id)
	{
		var_dump('신용카드 결제를 취소합니다');
	}
}