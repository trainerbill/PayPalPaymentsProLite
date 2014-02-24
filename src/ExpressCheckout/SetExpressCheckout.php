<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class SetExpressCheckout extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config = null)
	{
		$this->validation_parameters = array(

			'AMT',
			'ACTION',
			'TRXTYPE',
			'TENDER',
			'CURRENCYCODE',
			'RETURNURL',
			'CANCELURL'
		);
		
		
		$this->call_variables['TENDER'] = 'P';
		$this->call_variables['ACTION'] = 'S';
		
		
		parent::__construct($config);
	}
	
}