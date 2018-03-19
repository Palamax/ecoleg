<?php if($idGroupe != null){ ?>
<!-- modification un groupe -->
 <div class="jumbotron">
        <h1>Modification du groupe</h1>
        <p class="lead"><i>Un groupe de covoiturage est defini par une destination, une liste de 'point de covoiturage' et une liste de conducteur</i></p>
</div>
<div class="container">
  <form class="form-horizontal" method="post" action="">
    <div class="col-md-12">
          <div class="form-group">
              <span style="clear:both"></span>                                                                                       
              <p>
                Libellé : <input type="text" class="form-control" id="libelle" name="libelle"  value="<?php echo $groupe->LIBELLE; ?>" placeholder="Libellé" required>              
              </p>
              <p>
                <span clas="form-control">
                  Destination : 
                </span> 
              </p>
              <p>  
                <input type="text" id="destination" name="destination" value="<?php echo $groupe->DESTINATION; ?>" class="form-control form-control-inline" onfocus="javascript:$('#myModal').modal('show');" readonly />            
              </p>                            
            </div>
          <div class="form-group">
            <div class="col-sm-offset-6">
              <input type="submit" class="btn btn btn-success" value="Enregistrer"/>
            </div>
          </div>
    </div>
  </form>
</div>
<div class="container">
    <div class="row col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Liste des points de covoiturage</b></div>
          <div class="panel-body">
            <table class="table table-striped custab">
              <thead>
                   <tr>
                      <th>ADRESSE</th>
                      <th class="text-center">Action</th>
                  </tr>
              </thead>
              <?php foreach($liste_covoiturage as $covoiturage){ ?>

                    <tr>
                        <td><?php echo $covoiturage->ADRESSE; ?></td>
                        <td class="text-center">
                          <a href="<?php echo ADRESSE_ABSOLUE_URL . 'groupe/' . $groupe->ID . '/deleteCovoiturage/' . $covoiturage->ID; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>       

            <?php } ?>  

            </table>
            <form class="form-horizontal" method="post" action="">
              <p>  
                Adresse : 
                <input type="text" id="adresseCovoiturage" name="adresseCovoiturage" class="form-control form-control-inline" onfocus="javascript:$('#myModalCovoiturage').modal('show');" placeholder="Recherchez votre point de covoiturage" readonly />
              </p>   
                <input type="submit" class="btn btn btn-success" value="+"/>
            </form>            
          </div>
        </div>            
    </div>   
</div>
<div class="container">
    <div class="row col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Liste des passagers</b></div>
          <div class="panel-body">
            <table class="table table-striped custab">
              <thead>
                   <tr>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      <th class="text-center">Action</th>
                  </tr>
              </thead>
              <?php foreach($liste_groupePassager as $groupePassager){ ?>

                    <tr>
                        <td><?php echo $groupePassager->NOM; ?></td>
                        <td><?php echo $groupePassager->PRENOM; ?></td>
                        <td class="text-center">
                          <a href="<?php echo ADRESSE_ABSOLUE_URL . 'groupe/' . $groupe->ID . '/deletePassager/' . $groupePassager->ID; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>       

            <?php } ?>  

            </table>
            <form class="form-horizontal" method="post" action="">
                <select id="idPassagerAjouter" name="idPassagerAjouter">
                    <option value="" selected="selected"></option>
                    <?php foreach($liste_passager as $passager){ ?>
                        <option value="<?php echo $passager->ID; ?>"><?php echo $passager->NOM . ' ' . $passager->PRENOM; ?></option>
                    <?php } ?> 
                </select>
                <input type="submit" class="btn btn btn-success" value="+"/>
            </form>            
          </div>
        </div>            
    </div>   
</div>
<?php }else{ ?>

<!-- creation un groupe -->
 <div class="jumbotron">
        <h1>Création du groupe</h1>
        <p class="lead"><i>Un groupe de covoiturage est defini par une liste de 'point de covoiturage' et une liste de conducteur</i></p>
    </div>
<div class="container margin-auto">
  <form class="form-horizontal" method="post" action="">
    <div class="row col-md-12">
          <div class="form-group">
              <span style="clear:both"></span>                                                                                       
              <p>
                Libellé : <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="libelle" required>              
              </p>
              <p>
                <span clas="form-control">
                  Destination : 
                </span> 
              </p>
              <p>  
                <input type="text" id="destination" name="destination" class="form-control form-control-inline" onfocus="javascript:$('#myModal').modal('show');" readonly />            
              </p>                
          </div>
          <div class="form-group">
            <div class="col-sm-offset-6">
              <input type="submit" class="btn btn btn-success" value="Enregistrer"/>
            </div>
          </div>
    </div>
  </form>
</div>

<?php } ?>

<!-- Modal destination -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Rechercher votre destination</h4>
      </div>
      <div class="modal-body">
             <input type="text" id="adresseRecherchee" placeholder="Recherchez votre destination" class="form-control form-control-inline"/>
              <a href="#" onclick="showLocation('adresseRecherchee', 'destination');javascript:$('#myModal').modal('hide');"><span class="glyphicon glyphicon-map-marker form-control-inline"></a>
       </div>
    </div>
  </div>
</div>

<!-- Modal point de covoiturage -->
<div class="modal fade" id="myModalCovoiturage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Rechercher votre point de covoiturage</h4>
      </div>
      <div class="modal-body">
             <input type="text" id="rechercheCovoiturage" placeholder="Recherchez votre point de covoiturage" class="form-control form-control-inline"/>
              <a href="#" onclick="showLocation('rechercheCovoiturage', 'adresseCovoiturage');javascript:$('#myModalCovoiturage').modal('hide');"><span class="glyphicon glyphicon-map-marker form-control-inline"></a>
       </div>
    </div>
  </div>
</div>