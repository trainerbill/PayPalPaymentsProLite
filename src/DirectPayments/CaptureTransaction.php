<?php
namespace PayPalPaymentsProLite\DirectPayments;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class CaptureTransaction extends PayFlowAPI{

	
	
	public function __construct($config = null)
	{
		$this->validation_parameters = array(

			'AMT',
			'ORIGID',
			'TRXTYPE',
			'TENDER',	
		);
		
		$this->call_variables['TRXTYPE'] = 'D';
		$this->call_variables['TENDER'] = 'C';
		
		
		parent::__construct($config);
	}
	
}