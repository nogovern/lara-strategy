<?php

use Acme\Payment\PaymentInterface;
use Acme\Payment\PaymentByCreditCard;
use Acme\Payment\PaymentByMobile;
use Acme\Payment\PaymentByVirtualAccount;
use Acme\Payment\PaymentByRealAccount;

class Cashier
{
	private $payment;

	public function __construct(PaymentInterface $payment)
	{
		$this->payment = $payment;
	}

	public function charge($data = [])
	{
		return $this->payment->request($data);
	}

	public function getServiceId()
	{
		return $this->payment->getServiceId();
	}

	// 그냥 프로토타입
	public function prototype()
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


/////////////////////
Route::get('/', function()
{
	// $cashier = new Cashier(new PaymentByMobile);
	$cashier = new Cashier(new PaymentByCreditCard);
	$cashier->charge();

	return '';
});

Route::group(['prefix' =>'billing'], function()
{
	Route::get('/', 'BillingController@index');

	Route::get('mobile', 'BillingController@getMobileForm');
	Route::any('mobile_callback', 'BillingController@mc_callback');			// notiurl 방식 사용할 경우 호출 후 -> okurl 로 이동
	Route::post('mobile_okurl', 'BillingController@mc_okurl');

	Route::get('card', 'BillingController@getCardForm');
	Route::get('card/dbpath', 'BillingController@getCard');
	Route::get('card/redirpath', 'BillingController@getCard');

	Route::get('iche', 'BillingController@getIcheForm');
	Route::get('iche/okurl', 'BillingController@getIcheOkurl');
	Route::get('iche/notiurl', 'BillingController@getIcheNotiurl');
});

// test
Route::get('dbpath', 'BillingController@cc_dbpath');

Route::any('pay/cc/dbpath', 'Acme\PaymentByCreditCard@dbpath');
Route::any('pay/cc/redirpath', 'Acme\PaymentByCreditCard@redirpath');

Route::any('pay/mc/okurl', function() {});
Route::any('pay/mc/notiurl', function() {});




