<?php
    require_once "init.php";

    if (isset($_GET["delete"]) && isset($_GET["clinic"])) {
        unset($DATA["Clinics"][$_GET["clinic"]]);
        Utility::saveChanges();

        header("location: /");
    }
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

    <div class="rounded-md m-4 flex gap-4 flex-col">
        <div class="flex-1 shadow-md flex justify-between items-center p-2 rounded-md">
            <h1 class="font-bold text-2xl">Clinic</h1>
            <a class="bg-indigo-600 px-8 py-2 font-medium text-white rounded-md hover:bg-indigo-800" href="new-clinic.php">Add Clinic</a>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <?php foreach ($DATA["Clinics"] as $clinicName => $patients) { ?>
                <div class="border border-blue-500 shadow-md rounded-md text-center p-4">
                    <h1 class="font-bold text-2xl mb-4"><?= $clinicName; ?></h1>
                    <div class="flex flex-col">
                        <a class="bg-indigo-700 py-2 px-4 font-bold text-white rounded-md hover:bg-indigo-800" href="/view-patients.php?clinic=<?= $clinicName ?>">View Patient</a>
                        <a class="bg-red-700 py-2 px-4 font-bold text-white rounded-md hover:bg-red-800 flex mt-4" href="?clinic=<?= $clinicName ?>&delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Clinic
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>