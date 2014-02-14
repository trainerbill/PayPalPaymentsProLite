<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class DoExpressCheckout extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config)
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
		$this->call_variables['VERBOSITY'] = 'HIGH';
		
		
		parent::__construct($config);
	}
	
}