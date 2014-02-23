<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
require_once(__DIR__.'/../../../src/ExpressCheckout/SetExpressCheckout.php');


class SetExpressCheckoutTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$setec = new SetExpressCheckout();
		//Test instance
		$this->assertTrue($setec instanceof SetExpressCheckout);
		
		//Test validation parameters
		$this->assertNotEmpty($setec->getValidationParameters());
		
		$variables = $setec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['ACTION'],'S');
		$this->assertEquals($variables['TENDER'],'P');
		
	}
	
	public function testExecuteCall()
	{
		$setec = new SetExpressCheckout();
		$variables = array(
				'TRXTYPE'=>'S',
				'CURRENCYCODE' => 'USD',
				'RETURNURL' => 'http://localhost',
				'CANCELURL' => 'http://localhost',
				'AMT'	=> '12.00'
		);
		$setec->pushVariables($variables);
		$setec->executeCall();
		$response = $setec->getCallResponseDecoded();
		
		$this->assertEquals($response['RESULT'],0);
	}
	
	
}