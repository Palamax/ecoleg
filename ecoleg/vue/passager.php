<?php if($idPassager != null){ ?>
<!-- modifier un passager -->
 <div class="jumbotron">
        <h1>Modification du passager</h1>
        <p class="lead"><i>Le passager est defini par un nom, un prenom et une adresse</i></p>
    </div>
<div class="container">
  <form class="form-horizontal" method="post" action="">
    <div class="col-md-10">
          <div class="form-group">
            <div class="col-sm-offset-2">
            <span style="clear:both"></span>                                                                                       
            <p>
              Nom : <input type="text" class="form-control" id="nom" name="nom"  value="<?php echo $passager->NOM; ?>" placeholder="Nom" required>              
            </p>

            <p>
              Prénom : <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $passager->PRENOM; ?>" placeholder="Prenom" required>
            </p>
            <p>
              <span clas="form-control">
                Adresse : 
              </span> 
            </p>
            <p>  
              <input type="text" id="adresse" name="adresse" value="<?php echo $passager->ADRESSE; ?>" class="form-control form-control-inline" onfocus="javascript:$('#myModal').modal('show');" readonly />            
            </p> 
              <p>
                Téléphone : <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" value="<?php echo $passager->TELEPHONE; ?>">
              </p>    
              <p>
                Email : <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $passager->EMAIL; ?>">
              </p>                      
           </div>
          </div> 
          <div class="form-group">
            <div class="col-sm-offset-6">
              <input type="submit" class="btn btn btn-success" value="Enregistrer"/>
            </div>
          </div>    
    </div>
  </form>
</div>

<?php }else{ ?>

<!-- ajouter un passager -->
 <div class="jumbotron">
        <h1>Création du passager</h1>
        <p><i>Le passager est defini par un nom, un prenom et une adresse</i></p>
    </div>
<div class="container">
  <form class="form-horizontal" method="post" action="">
    <div class="col-md-10">
          <div class="form-group">
            <div class="col-sm-offset-2">
              <span style="clear:both"></span>                                                                                       
              <p>
                Nom : <input type="text" class="form-control" id="nom" name="nom"  placeholder="Nom" required>              
              </p>

              <p>
                Prénom : <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
              </p>
              <p>
                <span clas="form-control">
                  Adresse : 
                </span> 
              </p>
              <p>  
                <input type="text" id="adresse" name="adresse" class="form-control form-control-inline" onfocus="javascript:$('#myModal').modal('show');" readonly />            
              </p> 
              <p>
                Téléphone : <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
              </p>    
              <p>
                Email : <input type="text" class="form-control" id="email" name="email" placeholder="email">
              </p>                                     
           </div>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Rechercher votre adresse</h4>
      </div>
      <div class="modal-body">
             <input type="text" id="adresseRecherchee" placeholder="Recherchez votre adresse" class="form-control form-control-inline"/>
              <a href="#" onclick="showLocation('adresseRecherchee', 'adresse');javascript:$('#myModal').modal('hide');"><span class="glyphicon glyphicon-map-marker form-control-inline"></a>
       </div>
    </div>
  </div>
</div>