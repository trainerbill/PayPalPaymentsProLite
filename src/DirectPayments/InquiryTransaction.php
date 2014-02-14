<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class InquiryTransaction extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config)
	{
		$this->validation_parameters = array(

			'ORIGID',
			'TRXTYPE',
			'TENDER',	
		);
		
		$this->call_variables['TRXTYPE'] = 'I';
		$this->call_variables['TENDER'] = 'C';
		
		
		parent::__construct($config);
	}
	
}
