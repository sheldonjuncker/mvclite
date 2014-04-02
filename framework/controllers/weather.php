<?php

class Controller_weather extends Controller
{
	public function index()
	{
		
	}
	
	public function search($city = "", $state = "")
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://www.wunderground.com/cgi-bin/findweather/hdfForecast?query=$city+$state");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		print $server_output;
	}
}

?>