<?php
/*
 * TRGeocoder
 * Geocoder using the Google Geocoder API V3
 * 
 * @author Matthias Schmidt (http://www.m-schmidt.eu/)
 * @copyright 2010 Matthias Schmidt, the-reality.net
 * @version 1.0
 */
class TRGeocoder {
	private static $baseurl = 'http://maps.googleapis.com/maps/api/geocode/';
	public $coordinates = array();
	
	public function geocode($address) {
		$coordinates = array(); // reset
		
		$address = trim($address);
		
		if (empty($address)) {
			return false;
		}
		
		$url = self::$baseurl.'xml?address='.urlencode($address).'&sensor=false';
		
		$request = curl_init($url);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($request);
		curl_close($request);

		$xml = new SimpleXMLElement($response);
		$status = $xml->status;
		
		switch ($status) {
			case 'OK':
				$this->coordinates = array(
					'lat' => (float)$xml->result->geometry->location->lat,
					'lng' => (float)$xml->result->geometry->location->lng
				);

				return true;
				break;
			
			case 'ZERO_RESULTS':
				return false;
				break;
			
			case 'OVER_QUERY_LIMIT':
				throw new TRGeocoderOverQueryLimitException;
				break;
			
			case 'REQUEST_DENIED':
				throw new TRGeocoderRequestDeniedException;
				break;
			
			case 'INVALID_REQUEST':
				throw new TRGeocoderInvalidRequestException;
				break;
			
			default:
				throw new TRGeocoderException;
				break;
		}
	}
}

class TRGeocoderException extends Exception {};
class TRGeocoderOverQueryLimitException extends TRGeocoderException {};
class TRGeocoderRequestDeniedException extends TRGeocoderException {};
class TRGeocoderInvalidRequestException extends TRGeocoderException {};
?>