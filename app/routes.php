<?php

class Cashier
{
	private $billing;

	public function __construct(BillingInterface $billing)
	{
		$this->billing = $billing;
	}

	public function charge($data = [])
	{
		$this->billing->charge($data);
	}

	public function skel()
	{
		Stripe::setApiKey();
		Stripe_Charge::create([]);			// create a new charge
		Stripe_Invoice::create([]);	// 영수증 요청

		// 환불
		$ch = Stripe_Charge::retrieve("ch_14xxpw2eZvKYlo2CZa346egM"); 
		$re = $ch->refunds->create();
	}
}

interface BillingInterface {
	public function charge();
}

// 신용카드
class PayByCredit implements BillingInterface {
	public function charge($data = array())
	{
		var_dump('신용카드 결제를 요청합니다');
	}
}

// 핸드폰결제
class PayByMobile implements BillingInterface {

	public function charge($data = array())
	{
		var_dump('핸드폰 결제를 요청합니다');
	}
}

// 가상계좌
class PayByVirtualAccount implements BillingInterface {

	public function charge($data = array())
	{
		var_dump('가상계좌 결제를 요청합니다');
	}
}

// 이체
class PayByIche {

}

/////////////////////
Route::get('/', function()
{
	$payment = new Cashier(new PayByVirtualAccount);
	$payment->charge();

	return '';
});