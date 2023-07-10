<?php 
    require_once('../layouts/header.php');
    require_once('../services/__api.php');
    
    $weatherAPI = new WeatherAPI();
    $weatherData = null;

    if (isset($_POST['search'])) {
        $country = $_POST['search'];
        $weatherData = $weatherAPI->getWeatherbyCountry($country);
    }
    
?>
    <div class="container-fluid mx-auto search-bg h-[105vh]">
        <div class="grid sticky top-0">
            <div class="px-4 pt-3 text-white">
                <a href="current.php" class="fa-solid fa-arrow-left fa-2xl max-sm:text-lg"> </a>
            </div>
        </div>
        <nav>
            <form class="flex items-center px-5 py-5 lg:w-3/6 mx-auto" method="POST">   
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-300"></i>
                    </div>
                    <input type="text" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search" required>
                </div>
                <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-[var(--primary-button)] rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </nav>
        <div class="grid justify-center items-center text-center">
            <?=$weatherAPI->error; ?>
        </div>
        <?php if($weatherData !== null){ ?>
            <section>
                <div class="grid place-items-center">
                    <div>
                        <img class="text-center" src="https://openweathermap.org/img/wn/<?=$weatherAPI->weatherIcon ?>@4x.png" alt="">
                    </div>
                    <div class="text-4xl mb-4">
                        <?=$weatherAPI->cityName ?>, <?=$weatherAPI->countryName ?>
                    </div>
                    <div class="capitalize font-semibold text-2xl max-sm:text-lg">
                        <?=$weatherAPI->weatherCon; ?>
                    </div>
                    <div class="py-2 text-4xl font-bold max-sm:text-xl">
                        <?=$weatherAPI->temp; ?> °C
                    </div>
                </div>
            </section>
            <section>
                <div class="flex items-center px-5 py-5 lg:w-3/6 mx-auto">   
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
        <?php } ?>
    </div>
    
<?php 
    require_once('../layouts/footer.php');
?>