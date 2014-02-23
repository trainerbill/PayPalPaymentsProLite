<?php
namespace PayPalPaymentsProLite;
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');

class AuthorizationTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$auth = new AuthorizationTransaction();
		//Test instance
		$this->assertTrue($auth instanceof PayFlowAPI);
		$this->assertTrue($auth instanceof AuthorizationTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($auth->getValidationParameters());
		
		$variables = $auth->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'A');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	
}