<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');
require_once(__DIR__.'/../../../src/DirectPayments/CaptureTransaction.php');

class CaptureTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$capture = new CaptureTransaction();
		//Test instance
		$this->assertTrue($capture instanceof CaptureTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($capture->getValidationParameters());
		
		$variables = $capture->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'D');
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
		
		$capture = new CaptureTransaction();
		$variables = array(
			'ORIGID' => $response['PNREF'],
			'AMT' => '3.00',
			'CURRENCYCODE' => 'USD',
		);
		$capture->pushVariables($variables);
		$capture->executeCall();
		$response = $auth->getCallResponseDecoded();
		$this->assertEquals($response['RESULT'],0);
	}
	
	
}