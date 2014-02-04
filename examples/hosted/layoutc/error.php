<?php include(__DIR__.'/../../inc/header.php'); ?>
<div class="row">
	<div class="col-md-12">
		<h3>Payment Error</h3>
		<div>There was an error with your payment.  See below.</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3>Response</h3>
		<table class="table">
			<thead>
				<tr>
					<th>Variable</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_GET as $key => $value ): ?>
				<tr>
					<td><?php echo $key ?></td>
					<td><?php echo $value ?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<?php include(__DIR__.'/../../inc/footer.php'); ?>