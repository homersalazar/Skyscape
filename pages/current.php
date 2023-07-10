<?php 
    require_once('../layouts/header.php');
    require_once('../services/__api.php');
    $weatherAPI = new WeatherAPI();
?>

    <div class="container-fluid mx-auto bg h-[105vh]">
        <div class="flex justify-between sticky top-0">
            <div class="px-3 py-1 text-2xl font-bold">Skyscape</div>
            <div class="px-5 py-3">
                <a href="search.php">
                    <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
                </a>
            </div>
        </div>
        <?php if(isset($_GET['lat']) && isset($_GET['lon'])){ 
            $lat = $_GET['lat'];
            $lon = $_GET['lon'];
            $weatherData = $weatherAPI->getWeatherData($lat, $lon);
            ?>
            <div class="flex flex-col text-[var(--secondary-button)]">
                <div class="flex justify-center items-center">
                    <div>
                        <i class="fa-solid fa-location-dot mt-4 text-2xl"></i>
                        <span class="ml-2 text-4xl max-sm:text-2xl font-bold"><?=$weatherAPI->cityName ?>, <?=$weatherAPI->countryName ?></span>
                    </div>
                </div>
                <div class="flex justify-center items-center text-xl mt-3 semi-bold">
                    <?php echo date("l, j F") ?>
                </div>
                <div class="flex justify-center items-center text-9xl mt-3 font-bold">
                    <?=$weatherAPI->temp; ?>°
                </div>
                <div class="flex justify-center items-center text-4xl max-sm:text-xl font-bold">
                    <div>
                        <?=ucfirst($weatherAPI->weatherCon); ?>
                    </div>
                    <div> 
                        <img class="h-full w-40 z-1 p-0" src="https://openweathermap.org/img/wn/<?=$weatherAPI->weatherIcon ?>@2x.png" alt="">
                    </div>
                </div>
                <section>
                    <div class="flex items-center px-5 py-2 lg:w-3/6 mx-auto pb-10">   
                        <div class="grid grid-cols-3 grid-rows-2 text-center mx-auto w-full glossy rounded-lg shadow">
                            <div class="p-3">
                                <i class="fa-solid fa-xl fa-compress-arrows-alt"></i>                        
                                <p class="py-1"><?=$weatherAPI->pressure; ?> hpa</p>
                                <p class="text-gray-300">Pressure</p>
                            </div>
                            <div class="p-3">
                                <i class="fa-solid fa-xl fa-wind"></i>
                                <p class="py-1"><?=$weatherAPI->wind; ?> km/h</p>
                                <p class="text-gray-300">Wind</p>
                            </div>
                            <div class="p-3">
                                <i class="fa-solid fa-xl fa-eye"></i>
                                <p class="py-1"><?=$weatherAPI->visibility; ?> km</p>
                                <p class="text-gray-300">Visibility</p>
                            </div>
                            <div class="p-3">
                                <i class="fa-solid fa-xl fa-droplet"></i>
                                <p class="py-1"><?=$weatherAPI->humidity; ?> %</p>
                                <p class="text-gray-300">Humidity</p>
                            </div>
                            <div class="p-3">
                                <i class="fa-solid fa-xl fa-temperature-quarter"></i>
                                <p class="py-1"><?=$weatherAPI->minTemp; ?> %</p>
                                <p class="text-gray-300">Min Temp</p>
                            </div>
                            <div class="p-3">
                                <i class="fa-solid fa-xl fa-temperature-quarter"></i>
                                <p class="py-1"><?=$weatherAPI->maxTemp; ?> %</p>
                                <p class="text-gray-300">Max Temp</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php } else { 
            echo '<script>
                setTimeout(function() {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        window.location.href = "current.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude;
                    }, function(error) {
                        alert("Error getting location: " + error.message);
                    });
                }, 50);
            </script>';
        }  ?>

    </div>
<?php 
    require_once('../layouts/footer.php');
?>