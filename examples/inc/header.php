<?php 
//Get script info
$home = preg_match('/(.*examples)/',$_SERVER['SCRIPT_NAME'],$matches);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>PayPal Payments Pro Lite Examples</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
	<header style="margin-bottom:4em">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        	<div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   		<span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $matches[0] ?>">PayPal Payments Pro Lite Examples</a>
                </div>
            
	            <div class="collapse navbar-collapse">
		            <ul class="nav navbar-nav">
		                <li><a href="<?php echo $matches[0] ?>">Home</a></li>
		            </ul>
		        </div>
	        </div>
        </nav>
	</header>
	<div class="container" >