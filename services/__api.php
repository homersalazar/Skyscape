<?php
    class WeatherAPI {
        private $apiKey = 'fe388f01884018c8d11a93602b6f2f9b';
        private $apiUrl = 'https://api.openweathermap.org/data/2.5/weather';
        public $cityName;
        public $countryName;
        public $weatherIcon;
        public $weatherCon;
        public $temp;
        public $pressure;
        public $wind;
        public $visibility;
        public $humidity;
        public $maxTemp;
        public $minTemp;
        public $error;

        public function getWeatherData($lat, $lon) {
            $url = $this->apiUrl . "?lat=" . urlencode($lat) . "&lon=" . urlencode($lon) . "&appid=" . urlencode($this->apiKey);
            $response = $this->makeRequest($url);
            if ($response !== false) {
                $weatherData = json_decode($response, true);
                if ($weatherData !== null) {
                    $this->parseWeatherData($weatherData);
                    return $weatherData;
                } else {
                    throw new Exception("Error decoding weather data.");
                }
            } else {
                throw new Exception("Error fetching weather data.");
            }
        }

        public function getWeatherbyCountry($country) {
            $url = $this->apiUrl . "?q=" . urlencode($country) . "&appid=" . urlencode($this->apiKey);
            $response = $this->makeRequest($url);
            
            if ($response !== false) {
                $weatherData = json_decode($response, true);
        
                if ($weatherData !== null && isset($weatherData['cod']) && $weatherData['cod'] === 200) {
                    $this->parseWeatherData($weatherData);
                    return $weatherData;
                } else {
                    $this->error = "No weather data found for {$country}.";
                }
            } else {
                throw new Exception("Error fetching weather data.");
            }
        }
        
        
        private function makeRequest($url) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);
            if ($error) {
                throw new Exception("cURL error: " . $error);
            }
            return $response;
        }

        private function parseWeatherData($weatherData) {
            $this->cityName = $weatherData['name'];
            $this->countryName = $weatherData['sys']['country'];
            $this->weatherIcon = $weatherData['weather'][0]['icon'];
            $this->weatherCon = $weatherData['weather'][0]['description'];
            $this->temp = round($weatherData['main']['temp'] - 273.15);
            $this->pressure = round($weatherData['main']['pressure'] / 10);
            $this->wind = round(($weatherData['wind']['speed'] * 18) / 5);
            $this->visibility = $weatherData['visibility'] / 1000;
            $this->humidity = $weatherData['main']['humidity'];
            $this->maxTemp = $weatherData['main']['temp_max'] - 273.15;
            $this->minTemp = $weatherData['main']['temp_min'] - 273.15;
        }
    }
?>