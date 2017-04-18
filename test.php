<?php
require('weather.php');

main();

function main(){
	if (isset($_REQUEST['place'])){	
		if ($_REQUEST['place'] == '') { 
			echo 'bad request';
			die(); 
		}
		$place = $_REQUEST['place'];
		$weather = get_weather($place);
		echo $weather;
		die();

	} else {
		echo 'bad request';
		die();
	}
}

?>