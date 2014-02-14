<?php
namespace PayPalPaymentsProLite\SecureToken;
include_once(__DIR__.'/../PayFlowAPI.php');
use PayPalPaymentsProLite\PayFlowAPI;
class GetSecureToken extends PayFlowAPI{

	protected $validation_parameters;
	
	
	public function __construct($config)
	{
		$this->validation_parameters = array(

			'AMT',
			'CREATESECURETOKEN',
			'SECURETOKENID',
			'RETURNURL',
			'ERRORURL',	
			'CANCELURL'
		);
		
		$this->call_variables['CREATESECURETOKEN'] = 'Y';
		$this->call_variables['SECURETOKENID'] = md5(uniqid(rand(), true));
		
		
		parent::__construct($config);
	}
	
}