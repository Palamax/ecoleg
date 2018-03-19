    <div class="jumbotron">
        <h1>Liste des groupes</h1>
        <p class="lead"></p>
    </div>

    <div class="col-md-12">
	    <table class="table table-striped custab">
		    <thead>
		    	<a href="<?php echo ADRESSE_ABSOLUE_URL . 'groupe'; ?>" class="btn btn-primary btn-xs pull-right"><b>+</b> Nouveau groupe</a>
		        <tr>
		            <th>Id</th>
		            <th>Libellé</th>
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
	                	<a class='btn btn-info btn-xs' href="<?php echo ADRESSE_ABSOLUE_URL . 'groupe/' . $groupe->ID; ?>"><span class="glyphicon glyphicon-edit"></span></a> 
	                	<a href="<?php echo ADRESSE_ABSOLUE_URL . 'groupes/' . $groupe->ID; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
	            </tr>		    

			<?php } ?>  

	    </table>
    </div>
    