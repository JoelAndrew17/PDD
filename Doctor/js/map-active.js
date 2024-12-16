$(document).ready(function(){
/*====================================
	Google Map JS
======================================*/ 	
(function(){

	var map;
	map = new GMaps({
		el: '#myMap',
		lat: 13.025494,
		lng: 80.016444,
		scrollwheel:false,
		zoom: 15,
		zoomControl : false,
		panControl : false,
		streetViewControl : true,
		mapTypeControl: false,
		overviewMapControl: false,
		clickable: false
	});

	var image = 'img/map-marker.png';
	map.addMarker({
		lat: 13.023619,
		lng: 80.015579,
		icon: image,
		animation: google.maps.Animation.DROP,
		verticalAlign: 'bottom',
		horizontalAlign: 'left',
		backgroundColor: '#efece0',
	});
	var image = 'img/map-marker.png';
	map.addMarker({
		lat: 13.019797,
		lng: 80.013113,
		icon: image,
		animation: google.maps.Animation.DROP,
		verticalAlign: 'bottom',
		horizontalAlign: 'left',
		backgroundColor: '#efece0',
	});
	var image = 'img/map-marker.png';
	map.addMarker({
		lat: 13.024368,
		lng: 80.022509,
		icon: image,
		animation: google.maps.Animation.DROP,
		verticalAlign: 'bottom',
		horizontalAlign: 'left',
		backgroundColor: '#efece0',
	});

	var styles = [

		{
			"featureType": "road",
			"stylers": [
				{ "color": "#ffffff" }
			]
		},{
			"featureType": "water",
			"stylers": [
				{ "color": "#bde5f6" }
			]
		 },{
		  "featureType": "landscape",
			 "stylers": [
			 { "color": "#f2f2f2" }
			 ]
		},{
			"elementType": "labels.text.fill",
			"stylers": [
				{ "color": "#FF7550" }
			]
		},{
			"featureType": "poi",
			"stylers": [
			 { "color": "#e2f0cd" }
			]
		},{
			"elementType": "labels.text",
			"stylers": [
				{ "saturation": 2 },
				{ "weight": 0.3},
				{ "color": "#a8a8a8" }
			]
		}

	];

	 map.addStyle({
		styledMapName:"Styled Map",
		styles: styles,
		mapTypeId: "map_style"
	});

	map.setStyle("map_style");
}());

});