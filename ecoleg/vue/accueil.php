    <div class="jumbotron">
        <h1>Accueil</h1>
        <p class="lead"><i>Le TOP des covoitureurs</i></p>
    </div>
    <div class="col-md-12">
	    <table class="table table-striped custab">
		    <thead>
		        <tr>
		            <th>Nom</th>
		            <th>Prenom</th>
		            <th>Compteur</th>
		            <th>Kms</th>
		            <th>Economie</th>
		        </tr>
		    </thead>
		    <?php foreach($statistique as $stat){ ?>

	            <tr>
					<td><?php echo $stat->NOM; ?></td>
					<td><?php echo $stat->PRENOM; ?></td>
					<td><?php echo $stat->CPT; ?></td>
					<td><?php echo $stat->KMS; ?></td>
					<td><?php echo $stat->ECO; ?></td>
	            </tr>		    

			<?php } ?>  

	    </table>
    </div>