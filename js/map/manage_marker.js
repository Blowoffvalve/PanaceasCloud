var map;
var oms;
var markerArray = new HashMap();
var markerInfoMap = new HashMap();
var refreshSwitch = "0";
var intervalWholeMap = "";
var geocoder = L.mapbox.geocoder('mapbox.places');
//initialze the map and markers
function initialize(doctors, patients) {
	if(map == null){
         map = L.mapbox.map('map-canvas', 'mapbox.streets-satellite',{ zoomControl: false}).setView([38.943761, -92.329573], 15);
         new L.Control.Zoom({ position: 'topright' }).addTo(map);
         oms = new OverlappingMarkerSpiderfier(map);
     }	 

    var infowindowContent = "";
    //start loop for adding doctors information
    for (var i = 0; i < doctors.length; i++) {
      var lat = doctors[i].staffLat;
      var lng = doctors[i].staffLng;
      var time = doctors[i].staffTime;
      var Person_ID = doctors[i].staffId;
      var Person_name = doctors[i].staffName;
      var markerinfo = lat + "," + lng + "," + time;
	  infowindowContent = Person_ID + "," + Person_name + "," + time; 
        if(!markerArray.containsKey(Person_ID)){
             var marker = new L.Marker(new L.LatLng(lat, lng)).bindLabel("Staff: " + Person_name + " (" + Person_ID + ")");
             marker.setIcon(L.mapbox.marker.icon({
             	'marker-symbol': 'hospital',
             	'marker-color': '#2B8CBE'
             }));
             map.addLayer(marker);
             oms.addMarker(marker); 
             markerArray.put(Person_ID,marker);
             markerInfoMap.put(Person_ID, markerinfo);
             bindInfoWindowForStaff(markerArray.get(Person_ID), map, lat, lng, infowindowContent);
        }
    }//end loop for adding doctors information

     //start loop for adding patients information
    for (var i = 0; i < patients.length; i++) {
    	var lat = patients[i].patientLat;
    	var lng = patients[i].patientLng;
  
    	var time = patients[i].patientTime;
    	var Person_ID = patients[i].patientId;
    	var Person_name = patients[i].patientName;
    	var Person_status = patients[i].patientStatus;
    	var markerinfo = lat + "," + lng + "," + time;
    	infowindowContent = Person_ID + "," + Person_name + "," + Person_status + "," +time;
	        if(!markerArray.containsKey(Person_ID)){
	             var marker = new L.Marker(new L.LatLng(lat, lng)).bindLabel("Patient: " + Person_name + " (" + Person_ID + ")");
	             // alert(Person_status);
	             switch (Person_status) {
					  case "IMMEDIATE":
					    marker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#ff3c3c'
		            		// 'marker-size': 'small'
		           		}));
					    break;
					  case "MINOR":
					    marker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#3cff9e'
		            		// 'marker-size': 'small'
		           		}));
					    break;
					  case "DELAYED":
					    marker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#ffff3c'
		            		// 'marker-size': 'small'
		           		}));
					    break;
					  default:
					    marker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#414141'
		            		// 'marker-size': 'small'
		           		}));
					}

	             
	             map.addLayer(marker);
	             oms.addMarker(marker); 
	             markerArray.put(Person_ID,marker);
	             markerInfoMap.put(Person_ID, markerinfo);
	             bindInfoWindowForPatient(markerArray.get(Person_ID), map, lat, lng, infowindowContent);
	        }
    }//end loop for adding patients information

    // callRefreshMaps(refreshSwitch);
}//end for the end function initialize

function localRefresh(doctors, patients){
	var infowindowContent = "";
	var new_markerArray = new HashMap();

	//update 
	for (var i = 0; i < doctors.length; i++) {
	  	var new_Person_ID = doctors[i].staffId;
	  	var new_Person_name = doctors[i].staffName;
	  	var new_lat = doctors[i].staffLat;
	  	var new_lng = doctors[i].staffLng;
	  	var new_time = doctors[i].staffTime;
	  	var new_markerinfo = new_lat + "," + new_lng + "," + new_time;
	  		new_markerArray.put(new_Person_ID,i+1);

		infowindowContent = new_Person_ID + "," + new_Person_name + "," + new_time;
	    if(markerArray.containsKey(new_Person_ID)){
	    	var old_latlng = markerInfoMap.get(new_Person_ID).split(",");
	    	var old_time = old_latlng[2];

		    if(calDistance(old_latlng[0],old_latlng[1],new_lat,new_lng) > 100 && compareTime(old_time, new_time)){
		        map.removeLayer(markerArray.get(new_Person_ID));
		        oms.removeMarker(markerArray.get(new_Person_ID));
		        var tempMarker = new L.Marker(new L.LatLng(new_lat, new_lng)).bindLabel("Staff: " + new_Person_name + " (" + new_Person_ID + ")");
		        tempMarker.setIcon(L.mapbox.marker.icon({
	             	'marker-symbol': 'hospital',
	             	'marker-color': '#2B8CBE'
	             }));
		        map.addLayer(tempMarker);
		        oms.addMarker(tempMarker); 

		        markerArray.put(new_Person_ID, tempMarker);
		       
		        markerInfoMap.put(new_Person_ID,new_markerinfo);

		        bindInfoWindowForStaff(markerArray.get(new_Person_ID), map, new_lat, new_lng, infowindowContent);
		    }
		}else{
		        var tempMarker = new L.Marker(new L.LatLng(new_lat, new_lng)).bindLabel("Staff: " + new_Person_name + " (" + new_Person_ID + ")");
		        tempMarker.setIcon(L.mapbox.marker.icon({
	             	'marker-symbol': 'hospital',
	             	'marker-color': '#2B8CBE'
	             }));
		        map.addLayer(tempMarker);
		        oms.addMarker(tempMarker); 
		        markerArray.put(new_Person_ID, tempMarker);
		        markerInfoMap.put(new_Person_ID, new_markerinfo);
		        bindInfoWindowForStaff(markerArray.get(new_Person_ID), map, new_lat, new_lng, infowindowContent);
		}//end else
	 }//end for loop

	for (var i = 0; i < patients.length; i++) {
	 	var new_Person_ID = patients[i].patientId;
	 	var new_Person_name = patients[i].patientName;
	 	var new_Person_status = patients[i].patientStatus;
		var new_lat = patients[i].patientLat;
		var new_lng = patients[i].patientLng;
		var new_time = patients[i].patientTime;
		var new_markerinfo = new_lat + "," + new_lng + "," + new_time;
		new_markerArray.put(new_Person_ID,i+1);

		infowindowContent = new_Person_ID + "," + new_Person_name + "," + new_Person_status + "," + new_time;		
		if(markerArray.containsKey(new_Person_ID)){
		    var old_latlng = markerInfoMap.get(new_Person_ID).split(",");
		    var old_time = old_latlng[2];

		    if(calDistance(old_latlng[0],old_latlng[1],new_lat,new_lng) > 100 && compareTime(old_time, new_time)){
		        // markerArray.get(new_Person_ID).setMap(null);
		        map.removeLayer(markerArray.get(new_Person_ID));
		        oms.removeMarker(markerArray.get(new_Person_ID));
		        var tempMarker = new L.Marker(new L.LatLng(new_lat, new_lng)).bindLabel("Patient: " + new_Person_name + " (" + new_Person_ID + ") ");
		        switch (new_Person_status) {
					  case "IMMEDIATE":
					    tempMarker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#ff3c3c'
		            		// 'marker-size': 'small'
		           		}));
					    break;
					  case "MINOR":
					    tempMarker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#3cff9e'
		            		// 'marker-size': 'small'
		           		}));
					    break;
					  case "DELAYED":
					    tempMarker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#ffff3c'
		            		// 'marker-size': 'small'
		           		}));
					    break;
					  default:
					    tempMarker.setIcon(L.mapbox.marker.icon({
		            		'marker-color': '#414141'
		            		// 'marker-size': 'small'
		           		}));
				}
		        
		        map.addLayer(tempMarker);
		        oms.addMarker(tempMarker); 

		        //markerArray.remove(new_Person_ID);
		        markerArray.put(new_Person_ID, tempMarker);
		       
		        //markerInfoMap.remove(new_Person_ID);
		        markerInfoMap.put(new_Person_ID,new_markerinfo);

		        bindInfoWindowForPatient(markerArray.get(new_Person_ID), map, new_lat, new_lng, infowindowContent);
		    }
		}else{
	        var tempMarker = new L.Marker(new L.LatLng(new_lat, new_lng)).bindLabel("Patient: " + new_Person_name + " (" + new_Person_ID + ") ");
	        switch (new_Person_status) {
				  case "IMMEDIATE":
				    tempMarker.setIcon(L.mapbox.marker.icon({
	            		'marker-color': '#ff3c3c'
	            		// 'marker-size': 'small'
	           		}));
				    break;
				  case "MINOR":
				    tempMarker.setIcon(L.mapbox.marker.icon({
	            		'marker-color': '#3cff9e'
	            		// 'marker-size': 'small'
	           		}));
				    break;
				  case "DELAYED":
				    tempMarker.setIcon(L.mapbox.marker.icon({
	            		'marker-color': '#ffff3c'
	            		// 'marker-size': 'small'
	           		}));
				    break;
				  default:
				    tempMarker.setIcon(L.mapbox.marker.icon({
	            		'marker-color': '#414141'
	            		// 'marker-size': 'small'
	           		}));
			}
	        map.addLayer(tempMarker);
	        oms.addMarker(tempMarker); 
	        markerArray.put(new_Person_ID, tempMarker);
	        markerInfoMap.put(new_Person_ID, new_markerinfo);
	        bindInfoWindowForPatient(markerArray.get(new_Person_ID), map, new_lat, new_lng, infowindowContent);
		}//end else
	 };
	 
	 var rmv_markers = findItem(markerArray,new_markerArray);
	 if(rmv_markers != false){
	    for(var i = 0; i < rmv_markers.length; i++){
	        map.removeLayer(markerArray.get(rmv_markers[i]));
	        oms.removeMarker(markerArray.get(rmv_markers[i]));
	        markerArray.remove(rmv_markers[i]);
	        markerInfoMap.remove(rmv_markers[i]);
	    }
	 }
}
function findItem(old_markerArray, new_markerArray){
	var old_keys = old_markerArray.keySet();
	var old_keyArray = [];
	var j = 0;
	for(var i = 0; i < old_keys.length; i++){
	    if(!new_markerArray.containsKey(old_keys[i])){
	       old_keyArray[j] = old_keys[i];
	       j = j + 1;
	    }
	}

	if(old_keyArray.length > 0){
	    return old_keyArray;
	}else{
	    return false;
	}
}
function compareTime(old_time, new_time){
    var oldTime = Date.parse(old_time.replace(/-/g,"/"));
    var newTime = Date.parse(new_time.replace(/-/g,"/"));
    if(oldTime < newTime){
        return true;
    }else{
        return false;
    }
}

function toRad(d) {  
  	return d * Math.PI / 180; 
}
function calDistance(old_lat, old_lng, new_lat, new_lng) { 
  	var dis = 0;
  	var radLat1 = toRad(old_lat);
  	var radLat2 = toRad(new_lat);
  	var deltaLat = toRad(old_lat) - toRad(new_lat);
  	var deltaLng = toRad(old_lng) - toRad(new_lng);
  	var dis = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(deltaLat / 2), 2) 
      + Math.cos(radLat1) * Math.cos(radLat2) * Math.pow(Math.sin(deltaLng / 2), 2)));
  	return dis * 6378137;
} 


function bindInfoWindowForStaff(marker, map, lat, lng, description) {
    var contentString = description.split(",");
    var staffId = contentString[0];
    var staffName = contentString[1];
    var time = contentString[2];
    // alert(patientInfo[0] + " , " + patientInfo[1]);
    // alert(personId);
    var content = "";
    if(staffId != "10301"){
    	content = "<p>Person Info: <font color='#0000FF'><b>" + staffName + " (" + staffId + ")</b></font><br />" + 
	          	"Marker Time: <br>" + time +"</br>" + 
	          	"<button class='btn btn-primary btn-xsm' onclick='sendStaffId2VideoFeeds("+staffId+")' disabled><span class='glyphicon glyphicon-facetime-video'></span> Call Me</button></p>";

    	marker.bindPopup(content);
    }else{
    	content = "<p>Person Info: <font color='#0000FF'><b>" + staffName + " (" + staffId + ")</b></font><br />" + 
	          	"Marker Time: <br>" + time +"</br>" + 
	          	"<button class='btn btn-primary btn-xsm' onclick='sendStaffId2VideoFeeds("+staffId+")'><span class='glyphicon glyphicon-facetime-video'></span> Call Me</button></p>";

    	marker.bindPopup(content);
    }
	
   
            
}

function bindInfoWindowForPatient(marker, map, lat, lng, description) {
    var contentString = description.split(",");
    var patientId = contentString[0];
    var patientName = contentString[1];
    var patientStatus = contentString[2];
    var time = contentString[3];
    var content = "";
    
	content += "<p>Patient Info: <font color='#0000FF'><b><a a_person_id = '"+ patientId +"' class= 'trigger' data-toggle='modal' data-target='#editP_"+ patientId+"'>" + patientName + " (" + patientId + ")</a></b></font><br />";
	switch (patientStatus) {
	  case "IMMEDIATE":
	   	content += "Patient Status: <font color='#ff3c3c'>"+ patientStatus + "</font></br>";
	    break;
	  case "MINOR":
	    content += "Patient Status: <font color='#3cff9e'>"+ patientStatus + "</font></br>";
	    break;
	  case "DELAYED":
	    content += "Patient Status: <font color='#ffff3c'>"+ patientStatus + "</font></br>";
	    break;
	  default:
	    content += "Patient Status: <font color='#414141'>"+ patientStatus + "</font></br>";
	}
	content +=  "Marker Time: <br>" + time +"</br></p>";
    marker.bindPopup(content);
            
}



function sendStaffId2VideoFeeds(staffId){
	$.ajax({
          type: "GET",
          url: "video_streams.php",
          data: {staffId : staffId},
          async: true, /* If set to non-async, browser shows page as "Loading.."*/
          cache: false,
          success:function(msg){
              // alert(msg);
               window.open('https://192.168.88.198:3443', '_blank','height = 400, width = 500');

          },
          error: function(XMLHttpRequest, textStatus, errorThrown){
                  
          }
      });//end ajax
}


