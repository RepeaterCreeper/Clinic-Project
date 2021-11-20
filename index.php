<?php
    require_once "init.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="p-8 block bg-gray-800 text-white">
        <h1 class="text-3xl font-bold">Clinic System</h1>
        <p class="text-xs"><?= $VERSION; ?></p>
    </div>

    <div class="rounded-md m-4 flex gap-4">
        <div class="flex-1 shadow-md flex justify-between items-center p-2 rounded-md">
            <h1 class="font-bold text-2xl">Clinic</h1>
            <a class="bg-indigo-600 px-8 py-2 font-medium text-white rounded-md hover:bg-indigo-800" href="new-clinic.php">Add Clinic</a>
        </div>
    </div>
</body>
</html>