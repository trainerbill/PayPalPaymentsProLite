<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class GetExpressCheckout extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config = null)
	{
		$this->validation_parameters = array(
			'ACTION',
			//'TRXTYPE',
			'TENDER',
		
		);
		
		
		$this->call_variables['TENDER'] = 'P';
		$this->call_variables['ACTION'] = 'G';
		$this->call_variables['VERBOSITY'] = 'HIGH';
		
		parent::__construct($config);
	}
	
}