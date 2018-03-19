<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $nom_page;?></title>

	   <!-- Bootstrap -->
	   <link href="<?php echo ADRESSE_ABSOLUE_URL . BOOTSRAP_CSS; ?>" rel="stylesheet">
	   <link href="<?php echo ADRESSE_ABSOLUE_URL . STYLE_CSS; ?>" rel="stylesheet">
	</head>
	<body>

	    <div class="container login">

	      <form class="form-signin" action="" method="post">
	        <h2 class="form-signin-heading" style="padding-left:125px">
	       	 	<img src="<?php echo ADRESSE_ABSOLUE_URL . IMAGES_STYLE; ?>logo.png" alt="" width="200px"/>
	    	</h2>
	        <label for="inputEmail" class="sr-only">Adresse email</label>
	       <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse email" required autofocus>
	       <br>
	        <label for="inputPassword"  class="sr-only">Mot de passe</label>
	       <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
	        <br>
	        <button class="btn btn-lg btn-success btn-block" type="submit">Se connecter</button>
	      </form>

	    </div> 

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="<?php echo ADRESSE_ABSOLUE_URL . 'js/bootstrap.min.js'; ?>"></script>
	</body>
</html>    