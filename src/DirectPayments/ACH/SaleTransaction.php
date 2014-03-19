<?php
namespace PayPalPaymentsProLite\DirectPayments\ACH;
include_once(__DIR__.'/../../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class SaleTransaction extends PayFlowAPI{

	public function __construct($config = null)
	{
		//Construct Parent then overwrite
		parent::__construct($config);
		
		$this->validation_parameters = array(

			'AMT',
			'ACCT',
			'ABA',
			'ACCTTYPE',
			'NAME',
			'TRXTYPE',
			'TENDER',
			
		);
		
		$this->call_variables['TRXTYPE'] = 'S';
		$this->call_variables['TENDER'] = 'A';
		
		
		
	}
	
}