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
  mounted() {
	this.map = L.map('tracking-map').setView([0.33059453805927336, 32.58156572450088], 13);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(this.map);

	var latlngs = [
		[0.38939638445105657, 32.65154929673382],
		[0.3676553930685399, 32.75344467068635],
		[0.3845701252220957, 32.84312720400628],
		[0.3906124800183426, 32.979059986332196],
		[0.400264963181451, 33.00684131541112],
		[0.3966454149071369, 32.99717887192975],
		[0.3942323359954215, 32.99838703496668],
		[0.3942323359954215, 32.99838703496668],
		[0.3966454051996274, 33.010465157543145],
		[0.41112077176908224, 33.05277892515037],
		[0.4075021346801109, 33.080538859774336],
		[0.4067483734148347, 33.09765109665801],
		[0.4094616814478257, 33.10594231208639],
		[0.41036608283581905, 33.11950934527859],
		[0.40674839049510086, 33.125840513743285],
		[0.40916017600720356, 33.131568655300484],
		[0.4145867021636947, 33.13729678887447],
		[0.4325247898689024, 33.14920552050201],
		[0.43388163811633335, 33.15870251160624],
		[0.433730789930039, 33.15297415725421],
		[0.43795213302603375, 33.17046114677486],
		[0.44068419753141475, 33.17988263249232],
		[0.4384673340318203, 33.18337312510742],
		[0.4380752115321128, 33.18566990969563],
		[0.4394476422215919, 33.191221411440125],
		[0.6475247133304796, 34.26072703182277],
	];

	var polyline = L.polyline(latlngs, {color: 'red'}).addTo(this.map);
	
	this.map.fitBounds(polyline.getBounds());

	//L.marker([51.5, -0.09]).addTo(map)
	//	.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
	//	.openPopup();
  },
  created(){

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
	}
}
</script>

<style>
#tracking-map {
	height: 600px; 
	margin-top: 15px
}
</style>