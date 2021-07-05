<template>
  <div >
	<div id="tracking-map" ref="myMap" @ready="doSomethingOnReady()" style="z-index: 0"></div>	
  </div>
</template>

<script>
import { Icon, latLng } from "leaflet"
import "leaflet/dist/leaflet.css"
  
delete Icon.Default.prototype._getIconUrl;
Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});

export default {
  name: 'TrackingMap',
  props: [],
  data() {
    return {
      zoom: 13,
      center: latLng(0.33059453805927336, 32.58156572450088),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      //withPopup: latLng(47.41322, -1.219482),
      //withTooltip: latLng(47.41422, -1.250482),
      currentZoom: 11.5,
      currentCenter: latLng(0.33059453805927336, 32.58156572450088),
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5
      },
      showMap: true
    };
  },
  props: {
	  datapoints: {
		type: Array
	  },
	  locations: {
		type: Object
	  }
  },
  mounted() {
	this.map = L.map('tracking-map').setView([0.33059453805927336, 32.58156572450088], 13);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(this.map);
	
	if(this.datapoints.length === 0) return;
	
	const latlngs = this.datapoints.map(v => [ parseFloat(v.latitude), parseFloat(v.longitude)]);
	this.polyline = L.polyline(latlngs, {color: 'red'}).addTo(this.map);
	
	this.map.fitBounds(this.polyline.getBounds());
	
	var locationLayer = new L.FeatureGroup();
	var markerTemp = L.marker();
	
	var iconSettings = {
		mapIconUrl: '<svg version="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 149 178"><path fill="{mapIconColor}" stroke="#FFF" stroke-width="6" stroke-miterlimit="10" d="M126 23l-6-6A69 69 0 0 0 74 1a69 69 0 0 0-51 22A70 70 0 0 0 1 74c0 21 7 38 22 52l43 47c6 6 11 6 16 0l48-51c12-13 18-29 18-48 0-20-8-37-22-51z"/><circle fill="{mapIconColorInnerCircle}" cx="74" cy="75" r="61"/><circle fill="#FFF" cx="74" cy="75" r="{pinInnerCircleRadius}"/></svg>',
		mapIconColor: '#cc756b',
		mapIconColorInnerCircle: '#fff',
		pinInnerCircleRadius:48
	};
	
	
	var divIcon = L.divIcon({
		className: "leaflet-data-marker",
	  html: L.Util.template(iconSettings.mapIconUrl, iconSettings), 
	  iconAnchor  : [12, 32],
	  iconSize    : [25, 30],
	  popupAnchor : [0, -28]
	});
	
	// icon active state
	var divIconActive = L.divIcon({
		className: "leaflet-data-marker",
	  html: L.Util.template(iconSettings.mapIconUrl, iconSettings), //.replace('#','%23'),
	  iconAnchor  : [18, 42],
	  iconSize    : [36, 42],
	  popupAnchor : [0, -30]
	});

	var coords = [[53, 13],[49, 10],[46, 12],[51, 16]];
	var markerArray = [];
	var iMarker = -1;
	
	function setActiveIcon(marker) {
	  marker.setIcon(divIconActive);
	};
	
	 var marker = L.marker(latlngs[0], {
	  icon: divIcon,
	  id: 0
	 }).bindPopup('Start point')
	   .openPopup();

	  locationLayer.addLayer(marker);

	  marker.on('mouseover', function(e){
		if (iMarker == i) return;
		setTimeout(setActiveIcon, 10, this);
		if (iMarker >= 0) markerArray[iMarker].setIcon(divIcon);
		iMarker = 0;
	  });
	  
	  marker.on('mouseout', function(e){
		this.setIcon(divIcon);
		iMarker = -1;
	  });
	  
	  locationLayer.addTo(this.map);

  },
	components: { 
	},
	methods: {
		doSomethingOnReady() {
			this.map = this.$refs.trackingMap.mapObject
		},
		zoomUpdate(zoom) {
			this.currentZoom = zoom;
		},
		centerUpdate(center) {
			this.currentCenter = center;
		},
	},
	watch: {

	},
	computed: {

	}
}
</script>

<style>
#tracking-map {
	height: 600px; 
	margin-top: 15px
}
</style>