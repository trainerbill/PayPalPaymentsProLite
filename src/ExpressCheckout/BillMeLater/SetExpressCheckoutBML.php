<?php
namespace PayPalPaymentsProLite\ExpressCheckout\BillMeLater;
include_once(__DIR__.'/../SetExpressCheckout.php');
use PayPalPaymentsProLite\ExpressCheckout\SetExpressCheckout;
class SetExpressCheckoutBML extends SetExpressCheckout{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		$this->validation_parameters[] = 'SOLETYPE';
		$this->validation_parameters[] = 'USERSELECTEDFUNDINGSOURCE';
		
		
		
		$this->call_variables['SOLETYPE'] = 'SOLE';
		$this->call_variables['USERSELECTEDFUNDINGSOURCE'] = 'BML';
		
		
		parent::__construct();
	}
	
}