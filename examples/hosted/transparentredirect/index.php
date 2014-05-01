<?php
namespace PayPalPaymentsProLite\SecureToken;
include(__DIR__.'/../../../src/SecureToken/GetSecureToken.php');
use PayPalPaymentsProLite\SecureToken;
$gettok = new GetSecureToken();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'S',
		'AMT' => '100.00',
		'CURRENCY' => 'USD',
		'TENDER' => 'C',
		
		//URLS
		'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/index.php/','success.php',$_SERVER['SCRIPT_NAME']),
		'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/index.php/','cancel.php',$_SERVER['SCRIPT_NAME']),
		'ERRORURL' => 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/index.php/','error.php',$_SERVER['SCRIPT_NAME']),
		
		'SILENTTRAN' => 'TRUE', //REQUIRED for transparent redirect.
		
		'BILLTOFIRSTNAME' => 'Fred',
		'BILLTOLASTNAME' => 'Flintstone',
		'BILLTOSTREET' => '123 Bedrock',
		'BILLTOCITY' => 'Omaha',
		'BILLTOSTATE' => 'NE',
		'BILLTOZIP' => '68136',
		

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
	<div>In order to use the hosted layout you must setup your manager account properly. <a href="../instructions.php?layout=transparent">Instructions</a></div>
</div>

<?php include(__DIR__.'/../../inc/apicalloutput.php'); ?>

<div class="well">
	<!-- Use Secure Token to POST to Payflow -->
	<form action="<?php echo $gettok->getHostedEndpoint() ?>" method="post">
		
		<label for="ACCT">Card Number</label> <input name="ACCT" type="text" value="4532989784912829" /> <br/>
		<label for="EXPDATE">Expiration Date</label> <input name="EXPDATE" type="text" value="1120" /> <br/>
		<label for="CVV2">CVV2</label> <input name="CVV2" type="text" value="111" /> <br/>
		<input name="SECURETOKEN" type="hidden" value="<?php echo $rvars['SECURETOKEN'] ?>" /> <br/>
		<input name="SECURETOKENID" type="hidden" value="<?php echo $rvars['SECURETOKENID'] ?>" /> <br/>
		
		<input type="submit" />
	</form>
</div>



<?php include(__DIR__.'/../../inc/footer.php');?>