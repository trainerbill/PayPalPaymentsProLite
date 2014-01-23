<?php

include('../../src/DirectPayments/InquiryTransaction.php');
use PayPalPaymentsProLite\InquiryTransaction as InquiryTransaction;

$dcc = new InquiryTransaction();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf

/* store/upload the card info */

$variables = array(
	'ORIGID' => $_GET['PNREF']
);

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get the response decoded into an array
$response = $dcc->getCallResponseDecoded();

//Get the raw response
$string = $dcc->getCallResponse();

?>

<h3>Submitted</h3>

<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $dcc->getCallEndpoint() ?> -d "<?php echo $dcc->getCallQuery() ?>" </div>

<h3>Return String</h3>

<div style="max-width:800px;word-wrap:break-word;"><?php echo $dcc->getCallResponse() ?></div>

<h3>Return Decoded</h3>

<pre>
<?php
$decoded = $dcc->getCallResponseDecoded();
print_r($decoded);
?>
</pre>

