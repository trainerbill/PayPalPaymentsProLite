<?php
namespace PayPalPaymentsProLite\SecureToken;
require_once(__DIR__.'/../../../src/SecureToken/GetSecureToken.php');

class GetSecureTokenTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$token = new GetSecureToken();
		//Test instance
		$this->assertTrue($token instanceof GetSecureToken);
		
		//Test validation parameters
		$this->assertNotEmpty($token->getValidationParameters());
		
		$variables = $token->getCallVariables();
		//Test default values
		$this->assertEquals($variables['CREATESECURETOKEN'],'Y');
		$this->assertNotEmpty($variables['SECURETOKENID']);
		
	}
	
	public function testExecuteCall()
	{
		$token = new GetSecureToken();
		$variables = array(
			'TRXTYPE' => 'S',
			'AMT' => '100.00',
			'CURRENCY' => 'USD',
			
			//URLS
			'RETURNURL' => 'http://localhost',
			'CANCELURL' => 'http://localhost',
			'ERRORURL' => 'http://localhost',	
		);
		$token->pushVariables($variables);
		$token->executeCall();
		$response = $token->getCallResponseDecoded();
		$this->assertEquals($response['RESULT'],0);
	}
	
}