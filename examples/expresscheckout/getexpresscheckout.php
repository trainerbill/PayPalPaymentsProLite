<?php
include('../../src/ExpressCheckout/GetExpressCheckout.php');
include(__DIR__.'/../../config/config.php');
use PayPalPaymentsProLite\GetExpressCheckout;
$getec = new GetExpressCheckout($config);

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'A',			//You can pass A or S here.  Does not matter for Get Express Details
		'TOKEN' => $_GET['token'],	//GET TOKEN FROM URL
		
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get Submit String
$sstring = $getec->getCallQuery();

//Submitted Variables
$svars = $getec->getCallVariables();

//Get the response decoded into an array
$rvars = $getec->getCallResponseDecoded();

//Get the raw response
$rstring = $getec->getCallResponse();

//Get Endpoint
$endpoint = $getec->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../index.php">Back to home</a>
		<a class="btn btn-default" href="doexpresscheckout.php?token=<?php echo $_GET['token']?>&PayerID=<?php echo $_GET['PayerID']?>&AMT=<?php echo $rvars['AMT']?>">Do Express Checkout</a>
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>