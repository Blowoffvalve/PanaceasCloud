var geocoder = L.mapbox.geocoder('mapbox.places');

function showMap(err, data) {
    // The geocoder can return an area, like a city, or a
    // point, like an address. Here we handle both cases,
    // by fitting the map bounds to an area or zooming to a point.
    if (data.lbounds) {
        map.fitBounds(data.lbounds);
    } else if (data.latlng) {
        map.setView([data.latlng[0],data.latlng[1]], 18);
    }
}

function showWholeMap(){
    map.setView([38.943761, -92.329573], 15);
}

function geoLocate(address){
    var gc      = new google.maps.Geocoder(),
        opts    = { 'address' : address };

    gc.geocode(opts, function (results, status)
    {
        if (status == google.maps.GeocoderStatus.OK)
        {   
            var loc = results[0].geometry.location;

            var retLoc = JSON.parse(JSON.stringify(loc));
            map.setView([retLoc.lat,retLoc.lng], 18);
            
            // Success.  Do stuff here.
        }
        else
        {   
            geocoder.query({lat:38.943761, lng:-92.329573},showMap);
            // Ruh roh.  Output error stuff here
        }
    });
}