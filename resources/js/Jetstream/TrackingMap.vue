<template>
	<div >
	  <div id="tracking-map" ref="myMap" @ready="doSomethingOnReady()" style="z-index: 0"></div>	
	</div>
  </template>
  
  <script>
  import { Icon, latLng } from "leaflet"
  import "leaflet/dist/leaflet.css"
  import 'leaflet-fullscreen/dist/leaflet.fullscreen.css';
  import 'leaflet-fullscreen/dist/Leaflet.fullscreen';
  import polyline from '@mapbox/polyline'
  //polyline = require('@mapbox/polyline');
  
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
		showMap: true,
		map: null
	  };
	},
	props: {
		datapoints: {
		  type: Array
		},
		locations: {
		  type: Array
		},
		hotspots: {
		  type: Array
		},
		uids: {
		  type: Array
		},
		uid_list: {
		  type: Array
		},
	  start_date: {
		  type: String
	  },
	  end_date: {
		  type: String
	  },
		
	},
	mounted() {
	
  
	  
	  this.map = L.map('tracking-map').setView([0.33059453805927336, 32.58156572450088], 13);
	  this.map.addControl(new window.L.Control.Fullscreen());
  
	  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	  }).addTo(this.map);
  
		//Add road network shape file 
	   this.lc = L.control.layers(null, {}).addTo(this.map);
	   
	   //this.drawRoute();
	   
	   var _this = this;
	   setTimeout(() =>{
		  //_this.loadRoutes();
	   }, 1000)
	   
	  this.loadDriverMovements ();
	  
			  
	  //if(this.datapoints.length === 0) return;
	  
	  //this.map.fitBounds(this.polyline.getBounds());
	  
	  //Load hotsports 
	  this.loadHotspots();
	  console.log('this.loadHotspots();');
	  
	  var locationLayer = new L.FeatureGroup();
	  var markerTemp = L.marker();
	  
	  var iconSettings = {
		  mapIconUrl: '<svg version="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 149 178"><path fill="{mapIconColor}" stroke="#FFF" stroke-width="6" stroke-miterlimit="10" d="M126 23l-6-6A69 69 0 0 0 74 1a69 69 0 0 0-51 22A70 70 0 0 0 1 74c0 21 7 38 22 52l43 47c6 6 11 6 16 0l48-51c12-13 18-29 18-48 0-20-8-37-22-51z"/><circle fill="{mapIconColorInnerCircle}" cx="74" cy="75" r="61"/><circle fill="#FFF" cx="74" cy="75" r="{pinInnerCircleRadius}"/></svg>',
		  mapIconColor: '#cc756b',
		  mapIconColorInnerCircle: '#fff',
		  pinInnerCircleRadius:48
	  };
  
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
		  loadRoutes (){
			  if(this.uids.length === 0) return;
			  if(this.locations.length === 0) return;
			  for(var i = 0; i < this.uids.length; i++){
				  const uid = this.uids[i];
				  const routeShape = this.locations[uid];
				  
				  if(routeShape === null) continue;
				  
				  const polyLineCoords = polyline.decode(routeShape, 6);
				  //console.log("polyLineCoords:", polyLineCoords);
				  L.polyline(polyLineCoords, {color: 'blue', weight: 6}).addTo(this.map);
				  
				  if(i === 0){
					  this.map.setZoom(20);
					  this.map.panTo(new L.LatLng(polyLineCoords[0][0], polyLineCoords[0][1]));
				  }
			  }
  
				  
		  },
		  drawRoute(){
			  if(this.uids.length === 0) return;
			  var color = [];
			  var locationLayer = new L.FeatureGroup();
			  for(var i = 0; i < this.uids.length; i++){
				  const uid = this.uids[i];
				  if(uid === null) continue;
				  
				  const latlngs = this.locations[uid].map(v => [ parseFloat(v.latitude), parseFloat(v.longitude)]);
				  
				  const polyline = L.polyline(latlngs, {color: 'blue'}); 
				  locationLayer.addLayer(polyline);
				  
			  }
			  this.lc.addOverlay(locationLayer, 'Raw Traffic', { collapsed: false });
			  
		  },
  
  
		  loadHotspots () {
			  //console.log('Hotspots here.... +hh', this.hotspots);
			  
			  var locationLayer = new L.FeatureGroup();
			  this.hotspots.forEach(v => {
				  var circle = L.circle([parseFloat(v.latitude), parseFloat(v.longitude)], {
					  color: v.id === null ? 'orange' : 'red',
					  fillColor: v.id === null ? '#fcc603' : '#fc9272',
					  fillOpacity: 0.5,
					  radius: 2000,
					  stroke: '1px'
				  //});
				  }).addTo(this.map);
				  
				  locationLayer.addLayer(circle);
			  });
  
			   this.lc.addOverlay(locationLayer, 'Hotspots');
		  },
		  
		  loadDriverMovements (){
			  const len = this.uid_list.length;
			  for(var i =0; i < len; i++){
				  const uid = this.uid_list[i];
				  if(uid === '') continue;
				  
				  this.requestMovements(uid, 0, 20);
			  }
		  },
		  
		  requestMovements(uid, page, limit) {
			  var _this = this;
			  const start_date = this.start_date;
			  const end_date = this.end_date;
			  fetch('/api/movements?unique_id=' + uid + '&limit=' + limit + '&page=' + page + '&start_date=' + start_date + '&end_date=' + end_date, {
					 'method': 'GET',
					 'Content-Type': 'application/json'
				  }).then(response => response.json())
				   .then(resBody => {
					  resBody.data.forEach(v => {
						  const polyLineCoords = polyline.decode(v.shape, 6);
						  //console.log("polyLineCoords:" , polyLineCoords);
						  L.polyline(polyLineCoords, {color: 'blue', weight: 12, opacity: 0.4}).addTo(_this.map);
					  });
					  
					  const nextPage = page+1;
					  const offset = nextPage * resBody.limit;
					  const total = resBody.total;
					  //console.log('page:', page, ' nextPage:',nextPage, '  offset:', offset, ' resBody.total:', resBody.total );
					  if( offset < total){
						  setTimeout(function(){ 
							  _this.requestMovements(uid, nextPage, resBody.limit); 
						  }, 10000);
					  }
					  
			  });;
		  }
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