<?php
include('../../src/RecurringBilling/ConvertTransactionToRecurringBillingProfile.php');
use PayPalPaymentsProLite\ConvertTransactionToRecurringBillingProfile;
$rb = new ConvertTransactionToRecurringBillingProfile();

//You need to have a PNREF set.  Check URL Param first
if(isset($_GET['PNREF']))
	$pnref = $_GET['PNREF'];
else
	$pnref = ''; //MANUALLY SET PNREF

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pp_wpppf_recurringbilling_guide.pdf
$variables = array(
		
		'ORIGID' => $pnref,
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
<a href="cancel.php?PROFILEID=<?php echo $decoded['PROFILEID'] ?>">Cancel Profile</a><br/>