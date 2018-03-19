    <div class="jumbotron">
        <h1>Liste des passagers</h1>
        <p class="lead"></p>
    </div>


    <div class="col-md-12">
	    <table class="table table-striped custab">
		    <thead>
		    	<a href="<?php echo ADRESSE_ABSOLUE_URL . 'passager'; ?>" class="btn btn-primary btn-xs pull-right"><b>+</b> Nouveau passager</a>
		        <tr>
		            <th>ID</th>
		            <th>Nom</th>
		            <th>Prenom</th>
		            <th class="text-center">Action</th>
		        </tr>
		    </thead>
		    <?php foreach($liste_passager as $passager){ ?>

	            <tr>
	                <td><?php echo $passager->ID; ?></td>
					<td><?php echo $passager->NOM; ?></td>
					<td><?php echo $passager->PRENOM; ?></td>
	                <td class="text-center">
	                	<a class='btn btn-info btn-xs' href="<?php echo ADRESSE_ABSOLUE_URL . 'passager/' . $passager->ID; ?>"><span class="glyphicon glyphicon-edit"></span></a> 
	                	<a href="<?php echo ADRESSE_ABSOLUE_URL . 'passagers/' . $passager->ID; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
	            </tr>		    

			<?php } ?>  

	    </table>
    </div>
    