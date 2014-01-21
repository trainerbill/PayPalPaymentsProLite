<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class GetExpressCheckout extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		$this->validation_parameters = array(
			'ACTION',
			//'TRXTYPE',
			'TENDER',
		
		);
		
		
		$this->call_variables['TENDER'] = 'P';
		$this->call_variables['ACTION'] = 'G';
		$this->call_variables['VERBOSITY'] = 'HIGH';
		
		parent::__construct();
	}
	
}