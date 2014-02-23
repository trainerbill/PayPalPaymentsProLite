<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/RefundTransaction.php');
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');
require_once(__DIR__.'/../../../src/DirectPayments/CaptureTransaction.php');
class RefundTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$refund = new RefundTransaction();
		//Test instance
		$this->assertTrue($refund instanceof RefundTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($refund->getValidationParameters());
		
		$variables = $refund->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'C');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	public function testExecuteCall()
	{
		//Do authorization
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
		
		//Capture Authorization
		$capture = new CaptureTransaction();
		$variables = array(
				'ORIGID'=>$response['PNREF'],
				'AMT' => '3.00'
		);
		$capture->pushVariables($variables);
		$capture->executeCall();
		$response = $capture->getCallResponseDecoded();
		
		//Test Refund
		$refund = new RefundTransaction();
		$variables = array(
			'ORIGID'=>$response['PNREF'],
			'AMT' => '3.00'		
		);
		$refund->pushVariables($variables);
		$refund->executeCall();
		$response = $refund->getCallResponseDecoded();
		
		$this->assertEquals($response['RESULT'],0);
	}
	
}