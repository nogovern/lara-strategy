<?php namespace Acme\Payment;

class PaymentByVirtualAccount implements PaymentInterface {
	
	public function request($data = array())
	{
		return '가상계좌 결제는 아직 지원하지 않습니다.';
	}

	public function create($data= array())
	{

	}

	public function cancel($payment_id)
	{
		var_dump('가상계좌 결제를 취소합니다');
	}
}