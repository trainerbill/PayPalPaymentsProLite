<?php
namespace PayPalPaymentsProLite\RecurringBilling;
include_once('CreateRecurringBillingProfile.php');
use PayPalPaymentsProLite\RecurringBilling\CreateRecurringBillingProfile;
class ConvertTransactionToRecurringBillingProfile extends CreateRecurringBillingProfile{

	protected $validation_parameters;
	
	
	public function __construct($config = null)
	{
		parent::__construct($config);
		$this->validation_parameters = array(

			'PROFILENAME',
			'AMT',
			'TENDER',
			'START',
			'PAYPERIOD',
			'TERM',	
		);
		
		$this->call_variables['TRXTYPE'] = 'R';
		$this->call_variables['TENDER'] = 'C';
		$this->call_variables['ACTION'] = 'A';
	}
	
}