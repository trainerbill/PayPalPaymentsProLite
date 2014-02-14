<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class AuthorizationTransaction extends PayFlowAPI{

    public function __construct($config)
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