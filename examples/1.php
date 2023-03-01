<?php declare(strict_types=1);

use Carbon\Carbon;
use K118\DB\Exceptions\TrainNotFoundException;
use K118\DB\Wagenreihung;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    // Change this to a currently running train before executing
    $trainNumber = 73;
    $departure   = Carbon::create(2023, 3, 1, 13, 11);

    $vehicleGroups = Wagenreihung::fetch($trainNumber, $departure);

    foreach($vehicleGroups as $vehicleGroup) {
        foreach($vehicleGroup->vehicles as $vehicle) {
            echo $vehicleGroup->fahrzeuggruppebezeichnung . ': ';
            echo $vehicle->fahrzeugnummer . ' (Typ: ' . $vehicle->fahrzeugtyp . ') will be in section ' . $vehicle->fahrzeugsektor . PHP_EOL;
        }
    }
} catch(TrainNotFoundException $e) {
    echo 'Train not found' . PHP_EOL;
}