<?php
include('../../src/RecurringBilling/ConvertTransactionToRecurringBillingProfile.php');
use PayPalPaymentsProLite\RecurringBilling\ConvertTransactionToRecurringBillingProfile;
$rb = new ConvertTransactionToRecurringBillingProfile();



//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pp_wpppf_recurringbilling_guide.pdf
$variables = array(
		
		
		'AMT' => '100.00',
		'CURRENCYCODE' => 'USD',
		'PROFILENAME'=>'MyRecurringProfileName',	//Name this something unique to the customer
		'START' => date('mdY',strtotime('+1month')),//Start in one month
		'TERM'  =>	0,								//Number of payments to be paid.  Set to 0 to continue until deactivation
		'PAYPERIOD' => 'MONT',						//Payment Frequency.  See doc above for all values
);

//You need to have a PNREF set.  Check URL Param first
if(isset($_GET['PNREF']) || isset($_GET['BAID']) ) {
	if(isset($_GET['PNREF']))
		$variables['ORIGID'] = $_GET['PNREF'];
	else {
		$variables['BAID'] = $_GET['BAID'];
		$variables['TENDER'] = 'P';
	}
}
else
	die('You need to set a PNREF or BAID');

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