<?php
include('../../src/RecurringBilling/CreateRecurringBillingProfile.php');
include(__DIR__.'/../../config/config.php');
use PayPalPaymentsProLite\CreateRecurringBillingProfile;
$rb = new CreateRecurringBillingProfile($config);

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pp_wpppf_recurringbilling_guide.pdf
$variables = array(
		
		'ACCT' => '4532372117409864',				//Credit card number from getcreditcardnumbers.com
		'EXPDATE' => '1120',						//Expiration date.  Any date in the future
		'CVV2' => '111',							//CVV2 Code
		'AMT' => '100.00',
		'CURRENCYCODE' => 'USD',
		'PROFILENAME'=>'MyRecurringProfileName',	//Name this something unique to the customer
		'START' => date('mdY',strtotime('+1month')),//Start in one month
		'TERM'  =>	0,								//Number of payments to be paid.  Set to 0 to continue until deactivation
		'PAYPERIOD' => 'MONT',						//Payment Frequency.  See doc above for all values
);

//Place the variables onto the stack
$rb->pushVariables($variables);

//Execute the Call via CURL
$rb->executeCall();

//Get Submit String
$sstring = $rb->getCallQuery();

//Submitted Variables
$svars = $rb->getCallVariables();

//Get the response decoded into an array
$rvars = $rb->getCallResponseDecoded();

//Get the raw response
$rstring = $rb->getCallResponse();

//Get Endpoint
$endpoint = $rb->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../index.php">Back to home</a>
		<a class="btn btn-default" href="cancel.php?PROFILEID=<?php echo $rvars['PROFILEID'] ?>">Cancel Profile</a>
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>