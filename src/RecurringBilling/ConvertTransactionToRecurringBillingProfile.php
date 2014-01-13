<?php
namespace PayPalPaymentsProLite;
include_once('CreateRecurringBillingProfile.php');
class ConvertTransactionToRecurringBillingProfile extends CreateRecurringBillingProfile{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->validation_parameters = array(

			'PROFILENAME',
			'AMT',
			'ORIGID',
			'START',
			'PAYPERIOD',
			'TERM',	
		);
		
		$this->call_variables['TRXTYPE'] = 'R';
		$this->call_variables['TENDER'] = 'C';
		$this->call_variables['ACTION'] = 'A';
	}
	
}