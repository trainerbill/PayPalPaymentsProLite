<?php
include('../../src/ExpressCheckout/DoExpressCheckout.php');
use PayPalPaymentsProLite\DoExpressCheckout;
$doec = new DoExpressCheckout();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		
		'TRXTYPE' => 'S',			//Whatever you passed in the SetEC call
		'TOKEN' => $_GET['token'],	//GET TOKEN FROM URL
		'PAYERID' => $_GET['PayerID'],
		'AMT' => $_GET['AMT']
		
);

//Place the variables onto the stack
$doec->pushVariables($variables);

//Execute the Call via CURL
$doec->executeCall();

//Get the response decoded into an array
$response = $doec->getCallResponseDecoded();

//Get the raw response
$string = $doec->getCallResponse();

?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $doec->getCallEndpoint() ?> -d "<?php echo $doec->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $doec->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $doec->getCallResponseDecoded();
print_r($decoded);
?>
</pre>
<a href="../index.php">Back to home</a><br/>