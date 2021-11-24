<?php

require_once "init.php";

if (!isset($_GET["clinic"])) {
    header("location: /");
}

$clinicName = $_GET["clinic"];
$patients = $DATA["Clinics"][$clinicName]->getAllPatients();

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $DATA["Clinics"][$clinicName]->removePatient($id);
    Utility::saveChanges();

    header("location: view-patients.php?clinic=$clinicName");

}

if (isset($_GET["complete"])) {
    $id = $_GET["complete"];
    $patient = $DATA["Clinics"][$clinicName]->getPatient($id);
    $patient->setConsultationDetails("done", true);

    Utility::saveChanges();

    header("location: view-patients.php?clinic=$clinicName");
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
                <h1 class="font-medium text-xl"><?= ucwords($clinicName); ?></h1>
                <p class="text-sm text-gray-400">Viewing patients for <?= ucwords($clinicName); ?> clinic.</p>
            </div>
            <div>
                <a class="bg-red-500 px-8 py-2 font-medium text-white rounded-md hover:bg-red-600" href="index.php">Go Back</a>
                <a class="bg-indigo-600 px-8 py-2 font-medium text-white rounded-md hover:bg-indigo-700" href="/add-patients.php?clinic=<?= $clinicName; ?>">Add Patient</a>
            </div>
        </div>
        
        <div class="sm:overflow-hidden flex">
            <div class="flex flex-col w-full">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name / Address
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Age
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gender
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Consultation Details
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($patients)) { ?>
                                        <?php foreach ($patients as $patient) { ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            <?= $patient->getName(); ?>
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            <?= $patient->getAddress(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?= $patient->getAge() ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 font-bold">
                                                <?= strtoupper($patient->getGender()); ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <p><b>Time:</b> <?= $patient->getConsultationDetails("time") ?></p>
                                                <p><b>Has been consulted: </b> <?= $patient->getConsultationDetails("done") ? "YES" : "NO"; ?></p>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm">
                                                <?php if (!$patient->getConsultationDetails("done")) { ?>
                                                    <a href="?clinic=<?= $_GET["clinic"];?>&complete=<?= $patient->getId() ?>" class="text-blue-500 border py-2 px-4 border-gray-200 rounded-md font-medium hover:bg-blue-600 hover:text-white transition">Mark as completed</a>
                                                <?php } ?>
                                                <a href="?clinic=<?= $_GET["clinic"];?>&delete=<?= $patient->getId() ?>" class="text-red-500 border py-2 px-4 border-red-200 rounded-md font-medium hover:bg-red-600 hover:text-white transition">Delete Patient</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td class="px-6 py-4">No patients available for this clinic.</td>
                                        </tr>
                                    <?php } ?>

                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>