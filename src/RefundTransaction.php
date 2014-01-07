<?php
namespace PayPalPaymentsProLite;
include_once('PayFlowAPI.php');
class RefundTransaction extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		$this->validation_parameters = array(

			'AMT',
			'ORIGID',
			'TRXTYPE',
			'TENDER',	
		);
		
		$this->call_variables['TRXTYPE'] = 'C';
		$this->call_variables['TENDER'] = 'C';
		
		
		parent::__construct();
	}
	
}