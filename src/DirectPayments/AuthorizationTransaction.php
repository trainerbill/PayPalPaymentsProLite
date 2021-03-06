<?php
namespace PayPalPaymentsProLite\DirectPayments;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class AuthorizationTransaction extends PayFlowAPI{

	
	
	public function __construct($config = null)
	{
		$this->validation_parameters = array(

			'AMT',
			'ACCT',
			'EXPDATE',
			'TRXTYPE',
			'TENDER',	
		);
		
		$this->call_variables['TRXTYPE'] = 'A';
		$this->call_variables['TENDER'] = 'C';
		
		
		parent::__construct($config);
	}
	
}