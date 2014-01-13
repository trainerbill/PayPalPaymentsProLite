<?php
include('../../src/RecurringBilling/CancelRecurringBillingProfile.php');
use PayPalPaymentsProLite\CancelRecurringBillingProfile;
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

//Get the response decoded into an array
$response = $rb->getCallResponseDecoded();

//Get the raw response
$string = $rb->getCallResponse();

?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $rb->getCallEndpoint() ?> -d "<?php echo $rb->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $rb->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $rb->getCallResponseDecoded();
print_r($decoded);
?>
</pre>
<a href="../index.php">Back to home</a><br/>