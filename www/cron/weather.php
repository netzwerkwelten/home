<?php
/*
 * PiHome v2.0
 * http://pihome.harkemedia.de/
 *
 * PiHome Copyright (c) 2015, Sebastian Harke
 * Lizenz Informationen.
 *
 * This work is licensed under the Creative Commons Namensnennung - Nicht-kommerziell - 
 * Weitergabe unter gleichen Bedingungen 3.0 Unported License. To view a copy of this license,
 * visit: http://creativecommons.org/licenses/by-nc-sa/3.0/.
 *
*/
header('Content-Type: application/json');
error_reporting(0);
require_once '/home/pi/home/www/config/dbconfig.inc.php';
require_once '/home/pi/home/www/cron/functions.inc.php';
// Load Settings Data
$settings = settings();
// Set timezone and location data for Weather data
date_default_timezone_set($settings['timezone']);  
$city = $settings['city'];
$land = $settings['country_code'];
$api_key=$settings['weather_api'];
// Get Weather Data per openweathermap api
$weather_api = "http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$land."&appid=".$api_key;
$json = file_get_contents($weather_api);
file_put_contents('/home/pi/home/www/weather/weather.json', $json);
// Get Weather forecast
$forecast_api = "http://api.openweathermap.org/data/2.5/forecast?q=".$city.",".$land."&mode=json&appid=".$api_key;
$json_forecast = file_get_contents($forecast_api);
file_put_contents('/home/pi/home/www/weather/forecast.json', $json_forecast);
echo '1';


?>
