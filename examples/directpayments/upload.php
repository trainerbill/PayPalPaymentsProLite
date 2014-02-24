<?php

include('../../src/DirectPayments/UploadTransaction.php');
use PayPalPaymentsProLite\DirectPayments\UploadTransaction as UploadTransaction;
include('../../src/DirectPayments/ReferenceTransaction.php');
use PayPalPaymentsProLite\DirectPayments\ReferenceTransaction as ReferenceTransaction;

$dcc = new ReferenceTransaction();
$dcu = new UploadTransaction();


//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf

/* store/upload the card info */

$variables = array(
                //Credit card number from getcreditcardnumbers.com
                'ACCT' => '4532372117409864',
                //Expiration date.  Any date in the future
                'EXPDATE' => '1120'
);

//Place the variables onto the stack
$dcu->pushVariables($variables);

//Execute the Call via CURL
$dcu->executeCall();

//Get the response decoded into an array
$uresponse = $dcu->getCallResponseDecoded();

/* PayPal PNREF ID */
$pnref = $uresponse['PNREF'];

//Get the raw response
$ustring = $dcu->getCallResponse();

/* Charge using the stored card using a Reference Transaction */

$variables = array(
        'ORIGID' => $pnref,             /* paypal id PNREF */
        'TRXTYPE' => 'S',               /* S=Sale,A=Authorization */
        'AMT' => 19.95,
        'CURRENCYCODE' => 'USD',
        'CUSTOM' => 'The Test Payment'
);
$dcc->pushVariables($variables);
$dcc->executeCall();
$response = $dcc->getCallResponseDecoded();


?>

<h3>Submitted</h3>

<p>Store (Upload)</p>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $dcu->getCallEndpoint() ?> -d "<?php echo $dcc->getCallQuery() ?>" </div>

<p>Sale (Reference)</p>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $dcc->getCallEndpoint() ?> -d "<?php echo $dcc->getCallQuery() ?>" </div>

<h3>Return String</h3>

<p>Store (Upload)</p>

<div style="max-width:800px;word-wrap:break-word;"><?php echo $dcu->getCallResponse() ?></div>

<p>Sale (Reference)</p>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $dcc->getCallResponse() ?></div>

<h3>Return Decoded</h3>

<p>Store (Upload)</p>
<pre>
<?php
$decoded = $dcu->getCallResponseDecoded();
print_r($decoded);
?>
</pre>

<p>Sale (Reference)</p>
<pre>
<?php
$decoded = $dcc->getCallResponseDecoded();
print_r($decoded);
?>
</pre>


<a href="reference.php?PNREF=<?php echo $decoded['PNREF'] ?>">Do Reference Transaction</a>


