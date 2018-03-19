<?php if ($libelleErreur != ''){ ?>
<div class="container">
<div class="col-md-10">
	<div class="col-sm-offset-2">
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <?php echo $libelleErreur;?>
		</div>		
	</div>
</div>
</div>
<?php } ?> 