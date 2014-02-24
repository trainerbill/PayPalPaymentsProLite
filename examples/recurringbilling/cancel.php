<?php
include('../../src/RecurringBilling/CancelRecurringBillingProfile.php');
use PayPalPaymentsProLite\RecurringBilling\CancelRecurringBillingProfile;
$rb = new CancelRecurringBillingProfile();

//You need to have a PNREF set.  Check URL Param first
if(isset($_GET['PROFILEID']))
	$profileid = $_GET['PROFILEID'];
else
	$profileid = ''; //MANUALLY SET PNREF

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pp_wpppf_recurringbilling_guide.pdf
$variables = array(
		'ORIGPROFILEID' => $profileid,	//Recurring Billing Profile ID
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
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>