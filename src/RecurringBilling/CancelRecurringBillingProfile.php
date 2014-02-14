<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class CancelRecurringBillingProfile extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config = null)
	{
		parent::__construct($config);
		$this->validation_parameters = array(
			'ORIGPROFILEID',
		);
		
		$this->call_variables['TRXTYPE'] = 'R';
		$this->call_variables['ACTION'] = 'C';
		
	}
	
}