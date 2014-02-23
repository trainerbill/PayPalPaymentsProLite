<?php
namespace PayPalPaymentsProLite\RecurringBilling;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class CreateRecurringBillingProfile extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		parent::__construct();
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