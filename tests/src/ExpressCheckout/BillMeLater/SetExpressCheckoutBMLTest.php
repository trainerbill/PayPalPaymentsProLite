<?php
namespace PayPalPaymentsProLite\ExpressCheckout\BillMeLater;
require_once(__DIR__.'/../../../../src/ExpressCheckout/BillMeLater/SetExpressCheckoutBML.php');


class SetExpressCheckoutBMLTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$setec = new SetExpressCheckoutBML();
		//Test instance
		$this->assertTrue($setec instanceof SetExpressCheckoutBML);
		
		//Test validation parameters
		$this->assertNotEmpty($setec->getValidationParameters());
		
		$variables = $setec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['ACTION'],'S');
		$this->assertEquals($variables['TENDER'],'P');
		$this->assertEquals($variables['SOLETYPE'],'SOLE');
		$this->assertEquals($variables['USERSELECTEDFUNDINGSOURCE'],'BML');
		
	}
	
	public function testExecuteCall()
	{
		$setec = new SetExpressCheckoutBML();
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
		
		$this->assertEquals($response['RESULT'],0);
	}
	
	
}