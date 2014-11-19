<?php namespace Acme\Payment;

class PaymentByRealAccount implements PaymentInterface {
	
	public function request($data = array())
	{
		var_dump('실계좌이체를 요청합니다');
	}

	public function create($data= array())
	{

	}

	public function cancel($payment_id)
	{
		var_dump('실계좌이체를 취소합니다');
	}
}