<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
require_once(__DIR__.'/../../../src/ExpressCheckout/SetExpressCheckout.php');
require_once(__DIR__.'/../../../src/ExpressCheckout/GetExpressCheckout.php');


class GetExpressCheckoutTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$getec = new GetExpressCheckout();
		//Test instance
		$this->assertTrue($getec instanceof GetExpressCheckout);
		
		//Test validation parameters
		$this->assertNotEmpty($getec->getValidationParameters());
		
		$variables = $getec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['ACTION'],'G');
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
		
		$getec = new GetExpressCheckout();
		$variables = array(
				'TOKEN'=> $response['TOKEN'],
				'TRXTYPE'=>'S',
		);
		$getec->pushVariables($variables);
		$getec->executeCall();
		$response = $getec->getCallResponseDecoded();
		
		$this->assertEquals($response['RESULT'],0);
	}
	
	
}