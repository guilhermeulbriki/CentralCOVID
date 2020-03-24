let map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: -27.3544219, lng: -53.3942224 },
    zoom: 15,
    styles: [{
      "featureType": "poi",
      "stylers": [{
        "visibility": "off",
      }]
    }]
  });

  var iconBase = "./assets/images/points/";
  var icons = {
    hospital: {
      name: "Hospital",
      icon: iconBase + "blue-point.png"
    },
    Food: {
      name: "Lancherias",
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
