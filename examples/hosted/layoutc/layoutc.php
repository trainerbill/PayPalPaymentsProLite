<?php
namespace PayPalPaymentsProLite\SecureToken;
include(__DIR__.'/../../../src/SecureToken/GetSecureToken.php');
use PayPalPaymentsProLite\SecureToken;
$gettok = new GetSecureToken();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'S',
		'AMT' => '100.00',
		'CURRENCYCODE' => 'USD',
		
		//URLS
		'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/hosted/layoutc/success.php',
		'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/hosted/layoutc/cancel.php',
		'ERRORURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/hosted/layoutc/error.php',

);

//Place the variables onto the stack
$gettok->pushVariables($variables);

//Execute the Call via CURL
$gettok->executeCall();

//Get Submit String
$sstring = $gettok->getCallQuery();

//Submitted Variables
$svars = $gettok->getCallVariables();

//Get the response decoded into an array
$rvars = $gettok->getCallResponseDecoded();

//Get the raw response
$rstring = $gettok->getCallResponse();

//Get Endpoint
$endpoint = $gettok->getCallEndpoint();

include(__DIR__.'/../../inc/header.php');
?>
<div class="alert alert-danger">
	<h3>You must setup your manager account</h3>
	<div>In order to use the hosted layout you must setup your manager account properly. <a href="../instructions.php?layout=c">Instructions</a></div>
</div>

<?php include(__DIR__.'/../../inc/apicalloutput.php'); ?>


<!-- GET IFRAME -->
<iframe src="<?php echo $gettok->getHostedEndpoint(); ?>?SECURETOKEN=<?php echo $rvars['SECURETOKEN'] ?>&SECURETOKENID=<?php echo $rvars['SECURETOKENID'] ?>" width="490" height="565" border="0" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
<div><a class="btn btn-default" href="../../index.php">Back to home</a></div>
<?php include(__DIR__.'/../../inc/footer.php');?>