<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');

class AuthorizationTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$auth = new AuthorizationTransaction();
		//Test instance
		$this->assertTrue($auth instanceof AuthorizationTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($auth->getValidationParameters());
		
		$variables = $auth->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'A');
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
		$this->assertEquals($response['RESULT'],0);
	}
	
}