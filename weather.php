<?php
date_default_timezone_set('Asia/Taipei');
$_OPEN_WEATHER_MAP_APP_ID = "your openweathermap appID";
$_OPEN_WEATHER_MAP_URL = 'http://api.openweathermap.org/data/2.5/weather?APPID='.$_OPEN_WEATHER_MAP_APP_ID;

//If file exists and not expired, return weather.
//If file does not exist(first time request) or expired, send request to openweathermap.org and save it to local.


function get_weather($place){
	global $_OPEN_WEATHER_MAP_APP_ID, $_OPEN_WEATHER_MAP_URL;

	$mainFile = 'weather/'.$place.'.txt';
	$logFile = 'weather/log/'.$place.'.json';

	check_directory();

	if (file_exists($mainFile)) {
		$now = new DateTime();
		$mainFileCreatedTime = new DateTime();
		$mainFileCreatedTime->setTimestamp(filemtime($mainFile));
		$minutes = $mainFileCreatedTime->diff($now)->format("%i");
		if ($minutes < 60) {
			return @file_get_contents($mainFile);
		}
	}

	$content = @file_get_contents($_OPEN_WEATHER_MAP_URL.'&q='.$place);
	$contentDecoded = json_decode($content, true);

	if (isset($contentDecoded['weather'][0]['main'])) {
		$mainWeather = strtolower($contentDecoded['weather'][0]['main']);
		file_put_contents($mainFile, $mainWeather);
		file_put_contents($logFile, strtolower($content));
		return $mainWeather;
	}

	return 'error';
}

function check_directory(){
	$weatherDirectory = 'weather/log/';
	
	if (!file_exists($weatherDirectory)) {
		mkdir($weatherDirectory, 0777, true);
	}
}







?>