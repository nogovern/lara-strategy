<?php

class Cashier
{
	private $billing;

	public function __construct(BillingInterface $billing)
	{
		$this->billing = $billing;
		$this->setServiceId();
	}

	public function charge($data = [])
	{
		$this->billing->charge($data);
	}

	// 공통
	public function setServiceId()
	{
		$class_name = get_class($this->billing);

		switch($class_name)
		{
			case 'PayByVirtualAccount':
				$service_id = Config::get('site.pg.virtual.service_id');
				break;
			case 'PayByCreditCard':
				$service_id = Config::get('site.pg.cc.service_id');
				break;
			case 'PayByMobile':
				$service_id = Config::get('site.pg.mobile.service_id');
				break;
			case 'PayByIche':
				$service_id = Config::get('site.pg.iche.service_id');
				break;
			default:
				dd('에러!');
		}

		var_dump($service_id);
	}

	public function skel()
	{
		Stripe::setApiKey();
		// 결제 요청
		Stripe_Charge::create([]);			// create a new charge
		Stripe_Invoice::create([]);			// 영수증 요청

		// 환불
		$ch = Stripe_Charge::retrieve("ch_14xxpw2eZvKYlo2CZa346egM"); 
		$re = $ch->refunds->create();
	}
}

interface BillingInterface {
	public function charge();
}

// 신용카드
class PayByCreditCard implements BillingInterface {
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
	public function charge($data = array())
	{
		var_dump('계좌이체 결제를 요청합니다');
	}
}

/////////////////////
Route::get('/', function()
{


	$payment = new Cashier(new PayByCreditCard);
	$payment->charge();

	return '';
});

Route::get('billing', function()
{
	return View::make('billings.index');
});

// 핸드폰 결제 요청
Route::get('billing/mobile', function()
{
	return View::make('pg_sample.mobile.mc_web_utf8');
});

// kgpg 사에서 post 방식으로 호출됨
Route::post('billing/mobile/listen', function()
{
	return View::make('pg_sample.mobile.okurl_utf8');
	// return Input::all();
});

