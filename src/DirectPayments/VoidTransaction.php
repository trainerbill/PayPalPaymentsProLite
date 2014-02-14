<?php
namespace PayPalPaymentsProLite;
include_once(__DIR__.'/../PayFlowAPI.php');
class VoidTransaction extends PayFlowAPI{

	public function __construct($config)
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