<div class="row">
	<div class="col-md-12">
		<h3>Curl Call</h3>
		<pre>curl -i <?php echo $endpoint ?> -d "<?php echo $sstring ?>" </pre>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Submitted String</h3>
		<pre><?php echo $sstring ?></pre>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Submitted Decoded</h3>
		<pre><?php print_r($svars); ?></pre>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Return String</h3>
		<pre><?php echo $rstring ?></pre>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Return Decoded</h3>
		<pre><?php print_r($rvars); ?></pre>
	</div>
</div>