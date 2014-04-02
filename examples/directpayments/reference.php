<?php
include('../../src/DirectPayments/ReferenceTransaction.php');
use PayPalPaymentsProLite\DirectPayments\ReferenceTransaction;
$dcc = new ReferenceTransaction();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		
		'TRXTYPE' => 'S',	//Set to A for authorization
		
		'AMT' => '100.00',
		'CURRENCY' => 'USD',

		//Set userid as custom field
		'CUSTOM' => 'This is a test',

		//Line Items
		'L_NAME0' => 'Test Item',
		'L_DESC0' => 'Teset ITem desc',
		'L_AMT0' => '100.00',
);

if(isset($_GET['PNREF'])) {
	//Get the PNREF from original transaction
	$variables['ORIGID'] = $_GET['PNREF'];
}
else if(isset($_GET['BAID'])){
	//Get the BAID from original transaction
	$variables['BAID'] = $_GET['BAID'];
	//Overwrite tender to P
	$variables['TENDER'] = 'P';
	//ADD action DoEC
	$variables['ACTION'] = 'D';
}
else {
	die('You must set ORIGID or BAID');
}

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get Submit String
$sstring = $dcc->getCallQuery();

//Submitted Variables
$svars = $dcc->getCallVariables();

//Get the response decoded into an array
$rvars = $dcc->getCallResponseDecoded();

//Get the raw response
$rstring = $dcc->getCallResponse();

//Get Endpoint
$endpoint = $dcc->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>
<div class="row">
	<div class="col-md-12">
		<?php 
		$callvars = $dcc->getCallVariables();
		if($callvars['TRXTYPE'] == 'S'): ?>
		<a class="btn btn-default" href="refund.php?PNREF=<?php echo $rvars['PNREF'] ?>">Refund Transaction</a>
		<?php elseif($callvars['TRXTYPE'] == 'A') :?>
		<a class="btn btn-default" href="capture.php?PNREF=<?php echo $rvars['PNREF'] ?>">Capture Transaction</a>
		<a class="btn btn-default" href="void.php?PNREF=<?php echo $rvars['PNREF'] ?>">Void Transaction</a>
		<?php endif; ?>
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>
