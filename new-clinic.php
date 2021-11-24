<?php
require_once "init.php";

if (isset($_POST["clinicName"]) && !empty($_POST["clinicName"])) {
    $DATA->Clinics[$_POST["clinicName"]] = [];
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

    <div class="rounded-md m-4 flex flex-col shadow-md divide-solid divide-y">
        <div class="flex-1 flex justify-between items-center p-2 rounded-md">
            <div>
                <h1 class="font-medium text-xl">Add New Clinic</h1>
                <p class="text-sm text-gray-400">Fill out this form to add a new clinic.</p>
            </div>
            <a class="bg-red-400 px-8 py-2 font-medium text-white rounded-md hover:bg-red-600" href="index.php">Go Back</a>
        </div>
        <div class="sm:overflow-hidden grid grid-cols-2">
            <form method="POST" class="col-span-2">
                <div class="col-span-2 m-2">
                    <label for="clinicName" class="block font-medium mb-2">Clinic Name</label>
                    <input id="clinicName" name="clinicName" type="text" class="border border-gray-200 outline-none rounded-md p-2 text-sm shadow-sm focus:ring-2" />
                </div>
                <div class="col-span-2 px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="block inline-flex justify-end py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>