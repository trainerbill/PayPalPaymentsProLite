<?php
namespace PayPalPaymentsProLite\DirectPayments;
require_once(__DIR__.'/../../../src/DirectPayments/UploadTransaction.php');

class UploadTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$upload = new UploadTransaction();
		//Test instance
		$this->assertTrue($upload instanceof UploadTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($upload->getValidationParameters());
		
		$variables = $upload->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'L');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	public function testExecuteCall()
	{
		$upload = new UploadTransaction();
		$variables = array(
			'ACCT'=>'4556506716983263',
			'EXPDATE' => '1120',
			
		);
		$upload->pushVariables($variables);
		$upload->executeCall();
		$response = $upload->getCallResponseDecoded();
		$this->assertEquals($response['RESULT'],0);
	}
	
}