<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/ReferenceTransaction.php');
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');

class ReferenceTransactionTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rt = new ReferenceTransaction();
		//Test instance
		$this->assertTrue($rt instanceof ReferenceTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($rt->getValidationParameters());
		
		$variables = $rt->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'S');
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
		
		//Reference transaction
		$rt = new ReferenceTransaction();
		$variables = array(
				'ORIGID'=>$response['PNREF'],
				'AMT' => '3.00'
		);
		$rt->pushVariables($variables);
		$rt->executeCall();
		$response = $rt->getCallResponseDecoded();
		
		//Test Reference transaction
		$this->assertEquals($response['RESULT'],0);
	}
	
}