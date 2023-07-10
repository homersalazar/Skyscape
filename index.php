<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
        <title>Skyscape</title>
    </head>
    <body>
        <div id="gradient" class="flex justify-center items-center h-screen">
            <div class="grid">
                <div class="md:h-72 md:w-72">
                    <?php 
                        $currentHour = date('G');
                        $isAM = $currentHour < 12;
                        if ($isAM) { ?>
                            <img src="./assets/sun.svg" alt="" class="mx-auto">
                        <?php }else{ ?>
                            <img src="./assets/moon.svg" alt="" class="mx-auto">

                        <?php } ?>
                </div>
                <div class="text-white text-center text-4xl font-bold">
                    <h1>Skyscape</h1>
                </div>
                <div class="text-white italic mt-2 text-center">
                    <p>Your Personalized Weather Experience.</p>
                </div>
                <div class="text-center mt-3">
                    <a href="./pages/current.php" class="px-5 py-2 gap-3 bg-blue-500 border-2 border-blue-500 rounded-lg cursor-pointer transition duration-400 hover:bg-transparent hover:border-blue-500">
                        <span class="text-white font-semibold text-base transition duration-400">Get Start</span>     
                    </a>

                </div>
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
    </body>
</html>