<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');
require_once(__DIR__.'/../../../src/DirectPayments/VoidTransaction.php');

class VoidTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$void = new VoidTransaction();
		//Test instance
		$this->assertTrue($void instanceof VoidTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($void->getValidationParameters());
		
		$variables = $void->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'V');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	public function testExecuteCall()
	{
		$auth = new AuthorizationTransaction();
		$variables = array(
				'ACCT'=>'4556506716983263',
				'EXPDATE' => '1120',
				'CVV2' => '111',
				'AMT' => '3.00'
		);
		$auth->pushVariables($variables);
		$auth->executeCall();
		$response = $auth->getCallResponseDecoded();
		
		$void = new VoidTransaction();
		$variables = array(
			'ORIGID' => $response['PNREF'],
			
		);
		$void->pushVariables($variables);
		$void->executeCall();
		$response = $void->getCallResponseDecoded();
		$this->assertEquals($response['RESULT'],0);
	}
	
	
}