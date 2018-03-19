<div class="jumbotron">
    <h1>Covoiturage
      &#8239;<span class="badge"><?php echo $groupe->LIBELLE; ?></span>
      <span> 
      &#8239;<span title="Destination" class="badge"><span class="glyphicon glyphicon-flag">&#8239;<?php echo $groupe->DESTINATION; ?></span>  
      </span> 
  </h1>
  <p class="lead"><i>Veuillez sélectionner le point de covoiturage et le conducteur</i></p>
</div>
<div class="container">
    <div class="row col-md-12">
        <form class="form-horizontal" method="post" action="">
        <div class="form-group">
            <span style="clear:both"></span>   
            <?php if (!$isConsultation){ ?>                                                                                    
            <p>
              Point de covoiturage : 
              <select id="adresseCovoiturage" name="adresseCovoiturage" class="form-control">
                  <option value="" selected="selected"></option>
                  <?php foreach($liste_covoiturage as $covoiturage){ ?>
                      <option value="<?php echo $covoiturage->ADRESSE; ?>"><?php echo $covoiturage->ADRESSE; ?></option>
                  <?php } ?> 
              </select>                
            </p>
            
            <p>
              Conducteur : 
              <select id="idGroupePassager" name="idGroupePassager" class="form-control">
                  <option value="" selected="selected"></option>
                  <?php foreach($liste_groupePassager as $groupePassager){ ?>
                      <option value="<?php echo $groupePassager->ID; ?>"><?php echo $groupePassager->NOM . ' ' . $groupePassager->PRENOM;?></option>
                  <?php } ?> 
              </select>                
            </p>  
            <?php } ?>          
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Liste des passagers</div>
          <div class="panel-body">
            <table class="table table-striped custab">
              <thead>
                   <tr>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      <th>COMPTEUR</th>
                      <th>KMS</th>
                      <th>ECONOMIE</th>
                      <th></th>
                  </tr>
              </thead>
              <?php 
              $i = 0;
              foreach($liste_groupePassager as $groupePassager){ ?>
                    <tr <?php if ($i == 0){ echo 'style=background-color:#f2dede;font-weight:bold'; } ?>>
                        <td <?php if ($i == 0){ echo 'style=font-weight:bold'; } ?>><?php echo $groupePassager->NOM; ?></td>
                        <td><?php echo $groupePassager->PRENOM; ?></td>
                        <td><?php echo $groupePassager->COMPTEUR; ?></td>
                        <td><?php echo $groupePassager->KMS; ?></td>
                        <td><?php echo $groupePassager->ECONOMIE; ?></td>
                        <td> <?php if ($i == 0){ echo '<span class="glyphicon glyphicon-star-empty">'; } ?></td>
                    </tr>       

            <?php $i = $i + 1;} ?>  
            </table>          
          </div>
        </div>  
        <?php if (!$isConsultation){ ?> 
          <div class="form-group">
            <div class="col-sm-offset-5">
              <input type="submit" class="btn btn btn-success" value="Enregistrer"/>
            </div>
          </div>
        <?php } ?>  
        </form>       
    </div>   
</div>