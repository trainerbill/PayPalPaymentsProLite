<?php
namespace PayPalPaymentsProLite\DirectPayments;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class NonReferencedCreditTransaction extends PayFlowAPI{

	public function __construct($config = null)
	{
		$this->validation_parameters = array(

			'ACCT',
			'EXPDATE',
			'TRXTYPE',
			'TENDER',
		);
		
		$this->call_variables['TRXTYPE'] = 'C';
		$this->call_variables['TENDER'] = 'C';
		
		
		parent::__construct($config);
	}
	
}