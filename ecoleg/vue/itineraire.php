<div class="jumbotron">
        <h1>Calculer votre itinéraire</h1>
        <p class="lead"><i>veuillez saisir votre point de départ et votre destination</i></p>
</div>

<div class="container">
      <div class="col-md-10">
        <div id="destinationForm">
            <form action="" method="get" name="direction" id="direction">
                <label>Point de départ :</label>
                <input type="text" name="origin" id="origin">
                <label>Destination :</label>
                <input type="text" name="destination" id="destination">
                <input type="button" value="Calculer l'itinéraire" onclick="calculate();" class="btn btn btn-success">
            </form>
        </div>
        <div id="panel"></div>
        <div id="map"></div>
      </div> 	
</div>
<script type="text/javascript">
initialize();
</script>