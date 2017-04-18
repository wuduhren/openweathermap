<h1>It's a free weather api from openweathermap.</h1>
# how to use?

1. Go to <a>http://openweathermap.org/</a> create an account and get their appID.
2. Set the global variable ```$_OPEN_WEATHER_MAP_APP_ID``` in ```weather.php``` to your own appID.
3. Upload ```weather.php``` to your server. Call the function ```get_weather(city_name)``` to get the weather. Done!

# note
1. The json format from <a>http://openweathermap.org/</a> is like

	```
	{
	    "coord": {
	        "lon": 145.77,
	        "lat": -16.92
	    },
	    "weather": [
	        {
	            "id": 802,
	            "main": "Clouds",
	            "description": "scattered clouds",
	            "icon": "03n"
	        }
	    ],
	    "base": "stations",
	    "main": {
	        "temp": 300.15,
	        "pressure": 1007,
	        "humidity": 74,
	        "temp_min": 300.15,
	        "temp_max": 300.15
	    },
	    "visibility": 10000,
	    "wind": {
	        "speed": 3.6,
	        "deg": 160
	    },
	    "clouds": {
	        "all": 40
	    },
	    "dt": 1485790200,
	    "sys": {
	        "type": 1,
	        "id": 8166,
	        "message": 0.2064,
	        "country": "AU",
	        "sunrise": 1485720272,
	        "sunset": 1485766550
	    },
	    "id": 2172797,
	    "name": "Cairns",
	    "cod": 200
	}
	```
For simplicity I only return the main weather status.
You can do much more as you wish!

2. Why free? The <a>http://openweathermap.org/</a> gives us free request of 60 times per hour.

  So we can save the data (from <a>http://openweathermap.org/</a>) of any city we want to our server. And within an hour, we can use that data we saved to reply all the request to our server.
  
  If new request comes in, and the data on our server expired (60 minutes after first request), we will request and save new data to our server again.
  
3. I saved the main weather data under ```weather/``` in file name of ```city_name.txt```. Which content should only be a simple string like: cloud, rain, clear..., etc.

	For debuging, I saved whole data of city under ```weather/log/``` in file name of ```city_name.json```. Which content should be the same as the whole json from original api.
	
	If you want to save your bandwidth, just comment ```file_put_contents($logFile, strtolower($content));```.

4. For more documentation of the api: <a>http://openweathermap.org/current</a>

