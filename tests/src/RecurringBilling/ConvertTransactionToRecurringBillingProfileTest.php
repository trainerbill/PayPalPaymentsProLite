<?php
namespace PayPalPaymentsProLite\RecurringBilling;
require_once(__DIR__.'/../../../src/RecurringBilling/ConvertTransactionToRecurringBillingProfile.php');
require_once(__DIR__.'/../../../src/DirectPayments/AuthorizationTransaction.php');
use PayPalPaymentsProLite\DirectPayments\AuthorizationTransaction;
class ConvertTransactionToRecurringBillingProfileTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rb = new ConvertTransactionToRecurringBillingProfile();
		//Test instance
		$this->assertTrue($rb instanceof ConvertTransactionToRecurringBillingProfile);
		
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
		
		$rb = new ConvertTransactionToRecurringBillingProfile();
		$variables = array(
			'ORIGID' => $response['PNREF'],						
			'AMT' => '100.00',
			'CURRENCY' => 'USD',
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