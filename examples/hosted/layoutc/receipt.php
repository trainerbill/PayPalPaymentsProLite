<?php include(__DIR__.'/../../inc/header.php'); ?>
<div class="row">
	<div class="col-md-12">
		<h3>Payment Success</h3>
		<div>Thank you for your purchase.  Here are the return parameters for building your receipt or storing information in a database.  I would store the PNREF for your records</div>
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