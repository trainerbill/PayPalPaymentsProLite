<?php
namespace PayPalPaymentsProLite\RecurringBilling;
require_once(__DIR__.'/../../../src/RecurringBilling/CreateRecurringBillingProfile.php');


class CreateRecurringBillingProfileTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rb = new CreateRecurringBillingProfile();
		//Test instance
		$this->assertTrue($rb instanceof CreateRecurringBillingProfile);
		
		//Test validation parameters
		$this->assertNotEmpty($rb->getValidationParameters());
		
		$variables = $rb->getCallVariables();
		//Test default values
		$this->assertEquals($variables['TRXTYPE'],'R');
		$this->assertEquals($variables['ACTION'],'A');
		$this->assertEquals($variables['TENDER'],'C');
		
	}
	
	public function testExecuteCall()
	{
		$rb = new CreateRecurringBillingProfile();
		$variables = array(
			'ACCT' => '4532372117409864',				
			'EXPDATE' => '1120',						
			'CVV2' => '111',							
			'AMT' => '100.00',
			'CURRENCYCODE' => 'USD',
			'PROFILENAME'=>'MyRecurringProfileName',	
			'START' => date('mdY',strtotime('+1month')),
			'TERM'  =>	0,								
			'PAYPERIOD' => 'MONT',						
		);
		$rb->pushVariables($variables);
		$rb->executeCall();
		$response = $rb->getCallResponseDecoded();
		
		$this->assertEquals($response['RESULT'],0);
	}
	
	
}