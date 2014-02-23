<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class DoExpressCheckout extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		$this->validation_parameters = array(

			'AMT',
			'ACTION',
			'TRXTYPE',
			'TENDER',
			'PAYERID'
		);
		
		
		$this->call_variables['TENDER'] = 'P';
		$this->call_variables['ACTION'] = 'D';
		
		
		parent::__construct();
	}
	
}