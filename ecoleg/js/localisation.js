$(document).ready(function() {
	var i = 0;

	var classCity = '';
   	var classCountry = '';

   	var valCity = '';
   	var valCountry = '';

	$('#myTable #ip').each(function(){
      var ipVal = $(this).text();
      $.ajax({
        url: 'https://ipapi.co/'+ ipVal +'/json'
	  }).then(function(data, statusText, xhr) {
 		   
	  	   city = "#city";
	  	   country = "#country";

	  	   classCity = city.concat(i);
	  	   classCountry = country.concat(i);

   	  	   var valCity = data.city;
	  	   var valCountry = data.country;

	  	   if(valCity == null){
	  	   		valCity = "Non trouvé";
	  	   }
   	  	   if(valCountry == null){
	  	   		valCountry = "Non trouvé";
	  	   }
	   		$(classCity).html(valCity);
			$(classCountry).html(valCountry);
			i++;
	    })
    });    
});