<!DOCTYPE html>
<html>
<body>

<?php 
/*
 * ON this page you can display a reciept or success message whatever you want.
 * The message will display in the Iframe.  I generally don't do that and use javascript to break out of the
 * iframe and go to a reciept page to display the receipt.  see the javascript below and my reciept.php page
 */

	//First since we are breaking out of the iframe and redirecting to a new page I need to get the return
	//variables that are in the array and store them either in a session or repass them over the URL
	//I am just going to pass over the URL.
	session_start();	
	$url = 'receipt.php?';
	foreach($_GET as $key => $value)
	{
		$url .= $key . '=' . $value . '&';
	}

?>

<!-- Javascript to break the iframe and redirect to receipt.php -->
<script type="text/javascript">
  if (window!=top){top.location.href='<?php echo $url ?>';}
</script>


</body>
</html>