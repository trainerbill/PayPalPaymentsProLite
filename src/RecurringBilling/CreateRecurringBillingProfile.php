<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class CreateRecurringBillingProfile extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config)
	{
		parent::__construct($config);
		$this->validation_parameters = array(

			'PROFILENAME',
			'AMT',
			'ACCT',
			'EXPDATE',
			'START',
			'PAYPERIOD',
			'TERM',	
		);
		
		$this->call_variables['TRXTYPE'] = 'R';
		$this->call_variables['TENDER'] = 'C';
		$this->call_variables['ACTION'] = 'A';
		
		
		
	}
	
}