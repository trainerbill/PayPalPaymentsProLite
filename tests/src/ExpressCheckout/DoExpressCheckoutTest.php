<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
require_once(__DIR__.'/../../../src/ExpressCheckout/SetExpressCheckout.php');
require_once(__DIR__.'/../../../src/ExpressCheckout/DoExpressCheckout.php');


class DoExpressCheckoutTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$doec = new DoExpressCheckout();
		//Test instance
		$this->assertTrue($doec instanceof DoExpressCheckout);
		
		//Test validation parameters
		$this->assertNotEmpty($doec->getValidationParameters());
		
		$variables = $doec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['ACTION'],'D');
		$this->assertEquals($variables['TENDER'],'P');
		
	}
	
	public function testExecuteCall()
	{
		$setec = new SetExpressCheckout();
		$variables = array(
				'TRXTYPE'=>'S',
				'CURRENCY' => 'USD',
				'RETURNURL' => 'http://localhost',
				'CANCELURL' => 'http://localhost',
				'AMT'	=> '12.00'
		);
		$setec->pushVariables($variables);
		$setec->executeCall();
		$response = $setec->getCallResponseDecoded();
		
		$doec = new DoExpressCheckout();
		$variables = array(
				'TOKEN'=> $response['TOKEN'],
				'TRXTYPE'=>'S',
				'PAYERID' => 'QCHNYJU6PLMZE',
				'AMT'	=> '12.00'
		);
		$doec->pushVariables($variables);
		$doec->executeCall();
		$response = $doec->getCallResponseDecoded();
		//print_r($response);
		$this->assertEquals($response['RESULT'],1000);
	}
	
	
}