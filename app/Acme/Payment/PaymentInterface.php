<?php namespace Acme\Payment;

interface PaymentInterface {
	public function create($data = array());
	public function request($data = array());
	public function cancel($payment_id);
}