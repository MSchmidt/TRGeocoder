TRGeocoder
==========

PHP Geocoder using Google Geocoder API V3

TRGeocoder does only plain geocoding: *pass an address in -> get Lat/Lng out*

TRGeocoder was developed for the photo and nightlife community [the-reality.net](http://www.the-reality.net/)


What is Geocoding?
------------------

Geocoding is the process of finding associated geographic coordinates (often expressed as latitude and
longitude) from other geographic data, such as street addresses, or zip codes (postal codes).

Source: [Wikipedia](http://en.wikipedia.org/wiki/Geocoding "Wikipedia on Geocoding")


How to use
----------

Require TRGeocoder and fire a geocoding request by passing the address you wish
to geocode into the geocode() method:

	require('TRGeocoder.php);
	$tr_geocoder = new TRGeocoder();
	$tr_geocoder->geocode('02827 Goerlitz');
	
The result is stored in $coordinates

	print_r($tr_geocoder->coordinates);
	
	// Output:
	// Array
	// (
	//     [lat] => 51.1123561
	//     [lng] => 14.9634276
	// )


License
-------

Copyright (c) 2010 Matthias Schmidt, the-reality.net

TRGeocoder is released under the MIT License