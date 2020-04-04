var map;
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function initMap() {
  const mapOptions = {
    zoom: 15,
    center: { lat: -27.3544219, lng: -53.3942224 },
    disableDefaultUI:true,
    styles: [{
      "featureType": "poi",
      "stylers": [{
        "visibility": "off",
      }]
    }],
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  map = new google.maps.Map(document.querySelector("#map"), mapOptions);

  makeRequest('/solidariza/services/get_locations.php', data => {
    var data = JSON.parse(data.responseText);

    for (var i = 0; i < data.length; i++) {
      displayLocation(data[i]);
    }
  });

  function makeRequest(url, callback) {
    var request;
    if (window.XMLHttpRequest) {
      request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
    } else {
      request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
    }
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        callback(request);
      }
    }
    request.open("GET", url, true);
    request.send();
  }

  function displayLocation(location) {
    var marcador;

    if (location.tipo == 1) {
      marcador = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
    } else if (location.tipo == 2) {
      marcador = "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";

    } else if (location.tipo == 3) {
      marcador = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";

    }else{      
      marcador = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
  }

    var content = '<div class="infoWindow"><strong>' + location.name + '</strong>'
      + '<br/>' + location.address
      + '<br/>' + location.description + '</div>';

    if (parseInt(location.lat) == 0) {
      geocoder.geocode({ 'address': location.address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

          var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
            icon: marcador,
            title: location.name
          });

          google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(content);
            infowindow.open(map, marker);
          });
        }
      });
    } else {
      var position = new google.maps.LatLng(parseFloat(location.lat), parseFloat(location.lon));
      var marker = new google.maps.Marker({
        map: map,
        position: position,
        icon: marcador,
        title: location.name
      });

      google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(content);
        infowindow.open(map, marker);
      });
    }
  }

  var iconBase = "./assets/images/points/";
  var icons = {
    hospital: {
      name: "Hospital e UBS",
      icon: iconBase + "blue-point.png"
    },
    Food: {
      name: "Mercados",
      icon: iconBase + "yellow-point.png"
    },
    drugstore: {
      name: "Farmácias",
      icon: iconBase + "red-point.png"
    }
  };

  const legend = document.querySelector("#legend");
  const form = document.querySelector("#form");
  for (var key in icons) {
    let type = icons[key];
    let name = type.name;
    let icon = type.icon;
    let span = document.createElement("span");
    span.innerHTML = "<img src='" + icon + "'>" + name;
    legend.appendChild(span);
  }

  map.controls[google.maps.ControlPosition.LEFT_TOP].push(form);
  map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
}
