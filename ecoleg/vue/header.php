<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
	<meta name="Author" content="Loïc Baroni" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $nom_page;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo ADRESSE_ABSOLUE_URL . BOOTSRAP_CSS; ?>" rel="stylesheet">
	  <link href="<?php echo ADRESSE_ABSOLUE_URL . STYLE_CSS; ?>" rel="stylesheet">

<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBdH4G4F14RZV4F1gty8MZYiVHy0b4reB8"></script>
<script type="text/javascript">
var geocoder, location1, location2, gDir, map, panel, direction;
var sec=0;
 
  function initialize() {
    geocoder = new GClientGeocoder();
    gDir = new GDirections();
    GEvent.addListener(gDir, "load", function() {
      var drivingDistanceMiles = gDir.getDistance().meters / 1609.344;
      var drivingDistanceKilometers = gDir.getDistance().meters / 1000;
    });
      panel    = document.getElementById('panel');
      direction = new google.maps.DirectionsRenderer({
          map   : map,
          panel : panel 
    });
  }
  
  function showLocation(adresseR, adresseC) {
    var depart=document.getElementById(adresseR).value;
    geocoder.getLocations(depart, function (response) {
      if (!response || response.Status.code != 200)
      {
        alert("nous ne parvenons pas à localiser votre adresse");
        document.getElementById(adresseC).value = '';
      }
      else
      {
        location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
        document.getElementById(adresseC).value = location1.address;
      }
    });
  }

  function distanceAParcourir(adresseTo) {
    var adresseFrom = document.getElementById('adresseCovoiturage').value;
    gDir.load('from: ' + adresseFrom + ' to: ' + adresseTo);
  }

  function calculate(){
    origin      = document.getElementById('origin').value; // Le point départ
    destination = document.getElementById('destination').value; // Le point d'arrivé
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Mode de conduite
        }
        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
                console.debug('reponse:' + response.routes);
            }
        });
    }
};

</script>


  </head>
  <body onload="initialize();">

    <div class="container page">
	<!-- menu -->
	<div class="masthead">
        <img src="<?php echo ADRESSE_ABSOLUE_URL . IMAGES_STYLE; ?>logo.png" alt="" width="200px"/>
        <nav class="navbar navbar-inverse navbar-inverse-color">
          <ul class="nav navbar-nav">
          		<li <?php if($page=='accueil'){echo 'class="active"';}?> ><a href="<?php echo ADRESSE_ABSOLUE_URL; ?>accueil"><span class="glyphicon glyphicon-home"> Accueil</a></li>
      				<li <?php if($page=='passagers' || $page=='passager'){echo 'class="active"';}?> ><a href="<?php echo ADRESSE_ABSOLUE_URL; ?>passagers"><span class="glyphicon glyphicon-user"> Passagers</a></li>
      				<li <?php if($page=='groupes' || $page=='groupe'){echo 'class="active"';}?> ><a href="<?php echo ADRESSE_ABSOLUE_URL; ?>groupes"><span class="glyphicon glyphicon-cog"> Groupes</a></li>
      				<li <?php if($page=='covoiturages' || $page=='covoiturage'){echo 'class="active"';}?> ><a href="<?php echo ADRESSE_ABSOLUE_URL; ?>covoiturages"><span class="glyphicon glyphicon-road"> Covoiturage</a></li>
              <li <?php if($page=='itineraire'){echo 'class="active"';}?> ><a href="<?php echo ADRESSE_ABSOLUE_URL; ?>itineraire"><span class="glyphicon glyphicon-flag"> Itinéraire</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a style="margin-right:10px; color:white; text-decoration: none;" href="<?php echo ADRESSE_ABSOLUE_URL;?>passager/<?php echo$_SESSION['user']->ID; ?>"><?php echo 'Bonjour, '  . $_SESSION['user']->PRENOM; ?></a></li>
            <li><a style="margin-right:10px; color:white; text-decoration: none;" href="<?php echo ADRESSE_ABSOLUE_URL; ?>accueil"><span class="glyphicon glyphicon-calendar">&#8239;<?php echo date("d/m/y");?></a></li>
          </ul>
        </nav>
    </div>