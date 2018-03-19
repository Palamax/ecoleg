 <div class="jumbotron">
        <h1> Covoiturage</h1>
        <p class="lead"><i>Sélectionner le groupe de covoiturage concerné</i></p>
</div>

    <div class="col-md-12">
	    <table class="table table-striped custab">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>LIBELLE</th>
		            <th>Destination</th>
		            <th class="text-center">Action</th>
		        </tr>
		    </thead>
		    <?php foreach($liste_groupe as $groupe){ ?>

	            <tr>
	                <td><?php echo $groupe->ID; ?></td>
					<td><?php echo $groupe->LIBELLE; ?></td>
					<td><?php echo $groupe->DESTINATION; ?></td>
	                <td class="text-center">
	                	<a class='btn btn-info btn-xs' href="<?php echo ADRESSE_ABSOLUE_URL . 'covoiturage/' . $groupe->ID; ?>"><span class="glyphicon glyphicon-edit"></span> GO !!</a> 
	            </tr>		    

			<?php } ?>  

	    </table>
    </div>