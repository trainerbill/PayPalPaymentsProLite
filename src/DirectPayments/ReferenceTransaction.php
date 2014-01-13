<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class ReferenceTransaction extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct()
	{
		$this->validation_parameters = array(

			'AMT',
			'ORIGID',
			'TRXTYPE',
			'TENDER',	
		);
		
		$this->call_variables['TRXTYPE'] = 'S';
		$this->call_variables['TENDER'] = 'C';
		
		
		parent::__construct();
	}
	
}