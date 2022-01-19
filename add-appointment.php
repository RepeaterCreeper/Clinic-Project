<?php
require_once "init.php";

if (!isset($_GET["clinic"]) || empty($_GET["clinic"]) || !key_exists($_GET["clinic"], $DATA["Clinics"])) {
    header("location: /");
}

$clinicName = $_GET["clinic"];
$clinic = $DATA["Clinics"][$clinicName];
$patients = $clinic->getAllPatients();

if (isset($_POST["patientNames"])) {
    $fields = ["patientNames", "appointmentNurse", "appointmentDatetime"];

    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            echo $field . " empty";
        };
    }

    if (isset($_GET["clinic"]) && !empty($_GET["clinic"])) {
        $res = $clinic->addAppointment($_POST["patientNames"][0], $_POST["appointmentNurse"], $_POST["appointmentDatetime"]);
        if (!$res) {
            echo "<div class='bg-red-500 text-white p-4'><p><b>ERROR: </b> This time slot has already been taken. Choose a different time.</p></div>";
        } else {
            Utility::saveChanges();
            header("location: /view-patients.php?clinic={$_GET['clinic']}");
        }
    }
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
                <h1 class="font-medium text-xl">Add New Appointment</h1>
                <p class="text-sm text-gray-400">Fill out this form to add a new appointment for a patient in this clinic.</p>
            </div>
            <a class="bg-red-400 px-8 py-2 font-medium text-white rounded-md hover:bg-red-600" href="index.php">Go Back</a>
        </div>
        <div class="sm:overflow-hidden grid grid-cols-2">
            <form method="POST" class="col-span-2">
                <div class="col-span-2 m-2">
                    <label for="patientNames" class="block font-medium mb-2">Name</label>
                    <select id="patientNames" class="ring-2 ring-blue-500 p-2 rounded-md" name="patientNames[]" required>
                        <?php if (!empty($patients)) { ?>
                                <?php 
                                $first = false;
                                foreach ($patients as $patient) { ?>
                                    
                                    <option value='<?= $patient->getId(); ?>' <?= $first ? 'selected' : '' ?>><?= $patient->getName(); ?></option>
                                    <?php $first = true; ?>
                                <?php } ?>
                        <?php } else { ?>
                            <option selected default>No Patients Available</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-span-2 m-2">
                    <label for="appointmentNurse" class="block font-medium mb-2">Nurse Name</label>
                    <input id="appointmentNurse" name="appointmentNurse" type="text" class="border border-gray-200 outline-none rounded-md p-2 text-sm shadow-sm focus:ring-2" />
                </div>
                <div class="col-span-2 m-2">
                    <label for="appointmentDatetime" class="block font-medium mb-2">Appointment Date Time</label>
                    <input id="appointmentDatetime" name="appointmentDatetime" type="datetime-local" class="border border-gray-200 outline-none rounded-md p-2 text-sm shadow-sm focus:ring-2" />
                </div>
                <div class="col-span-2 px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="block inline-flex justify-end py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>