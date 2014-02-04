<?php include(__DIR__.'/../inc/header.php');?>
	<div class="row well well-sm">
		<div class="col-md-12">
			<h3>Enable secure tokens</h3>
			<div>
				First you must enable secure tokens in your manager account.
				<ul>
					<li>Login to <a target="_blank" href="http://manager.paypal.com">manager.paypal.com</a></li>
					<li>Click Service Settings</li>
					<li>Click Set Up under hosted checkout pages</li>
					<li>Scroll to the bottom and enable secure tokens</li>
					<li>Save Settings</li>
				</ul>
				<img class="img-responsive" src="../img/EnableSecureToken.png" alt="Secure token image" />
			</div>
		</div>
	</div>
	<?php if($_GET['layout'] == 'c'):?>
		<div class="row well well-sm">
			<div class="col-md-12">
				<h3>Customize the layout</h3>
				<ul>
					<li>Login to <a target="_blank" href="http://manager.paypal.com">manager.paypal.com</a></li>
					<li>Click Service Settings</li>
					<li>Click Customize under hosted checkout pages</li>
					<li>Select Layout C</li>
					<li>Save and Publish</li>
				</ul>
				<img class="img-responsive" src="../img/LayoutCcustomize.png" alt="Layout C Customize image" />
			</div>
		</div>
	<?php endif;?>
<?php include(__DIR__.'/../inc/footer.php');?>