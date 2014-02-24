<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/SaleTransaction.php');

class SaleTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$sale = new SaleTransaction();
		//Test instance
		$this->assertTrue($sale instanceof SaleTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($sale->getValidationParameters());
		
		$variables = $sale->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'S');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	public function testExecuteCall()
	{
		$sale = new SaleTransaction();
		$variables = array(
			'ACCT'=>'4556506716983263',
			'EXPDATE' => '1120',
			'CVV2' => '111',
			'AMT' => '3.00'		
		);
		$sale->pushVariables($variables);
		$sale->executeCall();
		$response = $sale->getCallResponseDecoded();
		$this->assertEquals($response['RESULT'],0);
	}
	
}