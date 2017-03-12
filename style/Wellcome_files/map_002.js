//~ /* IMPORTANT !!! QUAND TU FAIS DU WEB SI JAMAIS LA PAGE RECHARGE MAIS TU VOIS PAS DE CHANGEMENTS
//~ AVANT DE TE DIRE "MERDE CA MARCHE PAS" RECHARGE LA PAGE AVEC CTRL + F5 */
//~ 
//~ var map; // la map affichée
//~ var bounds = new google.maps.LatLngBounds();
//~ var geocoder;
//~ 
//~ function initialize() { //Fonction d'initialisation de la map
//~ 
	//~ var options = {
		//~ center: new google.maps.LatLng(47.2378, 6.0241), // centre la map sur cette longitude/latitude
		//~ zoom: 11, // reglage du zoom
		//~ mapTypeId: google.maps.MapTypeId.ROADMAP 
		//~ // Type de map : 
		//~ // Y'en a 4 d'apres la doc google : ROADMAP / HYBRID / SATELLITE / TERRAIN 
	//~ };
//~ 
	//~ map = new google.maps.Map(document.getElementById("map-canvas"), options);
//~ 
//~ }
//~ 
//~ google.maps.event.addDomListener(window, 'load', initialize);
//~ //Seule action du script, ça fait un listener sur la fenetre, des qu'elle est chargée (mot clef 'load' ça lance la fonction "initialize")
//~ 
//~ 
//~ function searchAddress(array) {
	//~ initialize();
	//~ /*for (var i = 0; i < array.length; i++) {
		//~ var g = new google.maps.Geocoder();
		//~ var address = array[i];
			//~ 
//~ 
		//~ 
//~ 
		//~ g.geocode({address: address}, function(results, status) {
//~ 
			//~ if (status == google.maps.GeocoderStatus.OK) {
//~ 
				//~ var myResult = results[0].geometry.location;
//~ 
				//~ createMarker(myResult);
//~ 
				//~ map.setCenter(myResult);
//~ 
				//~ //map.setZoom(17);
			//~ }
		//~ });
	//~ }*/
	//~ 
	//~ 
	//~ for (var i = 0; i < array.length; i++) {
		//~ geocodeAddress(array, i);
	//~ }
	//~ 
	//~ 
//~ }
//~ 
//~ function geocodeAddress(locations, i) {
    //~ var title = "lol";
    //~ var address = locations[i];
    //~ var url = "salut";
    //~ geocoder.geocode({
        //~ 'address': locations[i]
    //~ },
//~ 
    //~ function (results, status) {
        //~ if (status == google.maps.GeocoderStatus.OK) {
            //~ var marker = new google.maps.Marker({
                //~ icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                //~ map: map,
                //~ position: results[0].geometry.location,
                //~ title: title,
                //~ animation: google.maps.Animation.DROP,
                //~ address: address,
                //~ url: url
            //~ })
            //~ infoWindow(marker, map, title, address, url);
            //~ bounds.extend(marker.getPosition());
            //~ map.fitBounds(bounds);
        //~ } else {
            //~ alert("geocode of " + address + " failed:" + status);
        //~ }
    //~ });
//~ }
//~ 
//~ function infoWindow(marker, map, title, address, url) {
  //~ google.maps.event.addListener(marker, 'click', function() {
    //~ var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View location</a></p></div>";
    //~ iw = new google.maps.InfoWindow({
      //~ content: html,
      //~ maxWidth: 350
    //~ });
    //~ iw.open(map, marker);
  //~ });
//~ }
//~ 
//~ function createMarker(results) {
  //~ var marker = new google.maps.Marker({
    //~ icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
    //~ map: map,
    //~ position: results[0].geometry.location,
    //~ title: title,
    //~ animation: google.maps.Animation.DROP,
    //~ address: address,
    //~ url: url
  //~ })
  //~ bounds.extend(marker.getPosition());
  //~ map.fitBounds(bounds);
  //~ infoWindow(marker, map, title, address, url);
  //~ return marker;
//~ }














var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize(locations) {
		
	  map = new google.maps.Map(
	    document.getElementById("map_canvas"), {
	      center: new google.maps.LatLng(47.2378, 6.0241),
	      zoom: 13,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    });
	  geocoder = new google.maps.Geocoder();

	  for (i = 0; i < locations.length; i++) {


	    geocodeAddress(locations, i);
	  }
}
//~ google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
	  var title = locations[i][0];
	  var address = locations[i][1];
	  var url = locations[i][2];
	  var isCertified = locations[i][3];
	  geocoder.geocode({
	      'address': locations[i][1]
	    },

	    function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
			if (isCertified == 1) {
				var marker = new google.maps.Marker({
			
					icon: 'http://maps.google.com/mapfiles/ms/icons/red.png',	
					map: map,
					position: results[0].geometry.location,
					title: title,
					animation: google.maps.Animation.DROP,
					address: address,
					url: url
				})
			}
			else {
				var marker = new google.maps.Marker({
			
					icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',	
					map: map,
					position: results[0].geometry.location,
					title: title,
					animation: google.maps.Animation.DROP,
					address: address,
					url: url
				})
			}
		infoWindow(marker, map, title, address, url);
		bounds.extend(marker.getPosition());
		map.fitBounds(bounds);
	      } else {
		alert("geocode of " + address + " failed:" + status);
	      }
	    });
}

function infoWindow(marker, map, title, address, url) {
  google.maps.event.addListener(marker, 'click', function() {
    var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View location</a></p></div>";
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });
    iw.open(map, marker);
  });
}

function createMarker(results) {
  var marker = new google.maps.Marker({
    icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
    map: map,
    position: results[0].geometry.location,
    title: title,
    animation: google.maps.Animation.DROP,
    address: address,
    url: url
  })
  bounds.extend(marker.getPosition());
  map.fitBounds(bounds);
  infoWindow(marker, map, title, address, url);
  return marker;
}
