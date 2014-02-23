<?php
namespace PayPalPaymentsProLite;
require_once(__DIR__.'/../../src/PayFlowAPI.php');

class PayFlowAPITest extends \PHPUnit_Framework_TestCase
{
	
	public function testObjectConstruction()
	{
		$pf = new PayFlowAPI();
		//Test instance
		$this->assertTrue($pf instanceof PayFlowAPI);
		
		//Test Attributes
		$this->assertObjectHasAttribute('call_endpoint',$pf);
		$this->assertObjectHasAttribute('hosted_endpoint',$pf);
		$this->assertObjectHasAttribute('environment',$pf);
		$this->assertObjectHasAttribute('validation_parameters',$pf);
		$this->assertObjectHasAttribute('call_credentials',$pf);
		$this->assertObjectHasAttribute('call_query',$pf);
		$this->assertObjectHasAttribute('call_variables',$pf);
		$this->assertObjectHasAttribute('call_response',$pf);
		$this->assertObjectHasAttribute('call_response_decoded',$pf);
		
		//Make sure endpoint is test
		$this->assertEquals($pf->getCallEndpoint(),'https://pilot-payflowpro.paypal.com');
		
	}
	
	public function testConfiguration()
	{
		//Test config file
		$this->assertFileExists(__DIR__.'/../../config/config.php');
		
		require(__DIR__.'/../../config/config.php');
		
		//Make sure environment exists
		$this->assertNotEmpty($config['environment']);	
	}
	
	public function testCredentials()
	{
		//Test Credentials
		$this->assertFileExists(__DIR__.'/../../config/credentials.php');
		require(__DIR__.'/../../config/config.php');
		//Make sure credentials are correct.
		
		$this->assertArrayHasKey('PARTNER',$config['credentials']);
		$this->assertArrayHasKey('VENDOR',$config['credentials']);
		$this->assertArrayHasKey('USER',$config['credentials']);
		$this->assertArrayHasKey('PWD',$config['credentials']);
		
		//Make sure credentials are set to my test credentials
		$this->assertEquals('PayPal',$config['credentials']['PARTNER']);
		$this->assertEquals('andrewawesome',$config['credentials']['VENDOR']);
		$this->assertEquals('website',$config['credentials']['USER']);
		$this->assertEquals('test1234',$config['credentials']['PWD']);
	}
	
	public function testSetCredentials()
	{
		require(__DIR__.'/../../config/config.php');
		$pf = new PayFlowAPI();
		$creds = $pf->setCredentials($config['credentials']);
		$this->assertArrayHasKey('PARTNER',$creds);
		$this->assertArrayHasKey('VENDOR',$creds);
		$this->assertArrayHasKey('USER',$creds);
		$this->assertArrayHasKey('PWD',$creds);
		
	}
	
	public function testPushVariables()
	{
		$pf = new PayFlowAPI();
		
		$variables = array(
			'TEST' => 'ME',
			'OKIE' => 'dokie'		
		);
		
		$pf->pushVariables($variables);
		
		$rvars = $pf->getCallVariables();
		$this->assertEquals($rvars['TEST'],'ME');
		$this->assertEquals($rvars['OKIE'],'dokie');
	}
	
	public function testClearVariables()
	{
		$pf = new PayFlowAPI();
		$variables = array(
				'TEST' => 'ME',
				'OKIE' => 'dokie'
		);
		$pf->pushVariables($variables);
		$pf->clearVariables();
		
		//Test clear variables
		$this->assertEmpty($pf->getCallVariables());
		
		
	}
	
	public function testClearCredentials()
	{
		require(__DIR__.'/../../config/config.php');
		$pf = new PayFlowAPI();
		$creds = $pf->setCredentials($config['credentials']);
		
		$pf->clearCredentials();
		
		//Test clear variables
		$this->assertEmpty($pf->getCredentials());
	}
	
	public function testGetApiString()
	{
		$pf = new PayFlowAPI();
		
		$variables = array(
				'TEST' => 'ME',
				'OKIE' => 'dokie'
		);
		
		$pf->pushVariables($variables);
		$string = $pf->getApiString();
		$this->assertEquals('PARTNER=PayPal&VENDOR=andrewawesome&USER=website&PWD=test1234&VERBOSITY=HIGH&TEST=ME&OKIE=dokie&VERBOSITY=HIGH',$string);
	}
	
	public function testDecodeReturn()
	{
		$pf = new PayFlowAPI();
		
		$string="TEST=ME&OKIE=dokie&VERBOSITY=HIGH";
		$decode = $pf->decodeReturn($string);
		
		$this->assertEquals($decode,array(
			'TEST'=>'ME',
			'OKIE'=>'dokie',
			'VERBOSITY'=>'HIGH'
		));
	}
	
	/*
	public function testExecuteCall()
	{
		$pf = new PayFlowAPI();
		$pf->executeCall();
		
		//Test responses
		$this->assertNotEmpty($pf->getCallResponse());
		$this->assertNotEmpty($pf->getCallResponseDecoded());
		
		$response = $pf->getCallResponseDecoded();
		
		//Test PayPal Response.  We should get user authentication error.
		$this->assertEquals($response['RESULT'],1);
	}
	*/
}