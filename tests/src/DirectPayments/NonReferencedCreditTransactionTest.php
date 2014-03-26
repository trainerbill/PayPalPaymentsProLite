<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/NonReferencedCreditTransaction.php');

class NonReferencedCreditTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$refund = new NonReferencedCreditTransaction();
		//Test instance
		$this->assertTrue($refund instanceof NonReferencedCreditTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($refund->getValidationParameters());
		
		$variables = $refund->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'C');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	public function testExecuteCall()
	{
		
		
		//Test Refund
		$refund = new NonReferencedCreditTransaction();
		$variables = array(
				'ACCT'=>'4556506716983263',
				'EXPDATE' => '1120',
				'AMT' => '3.00'
		);
		$refund->pushVariables($variables);
		$refund->executeCall();
		$response = $refund->getCallResponseDecoded();
		
		$this->assertEquals($response['RESULT'],0);
	}
	
}