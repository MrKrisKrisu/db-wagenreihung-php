<?php declare(strict_types=1);

use K118\DB\Wagenreihung;
use K118\DB\Exceptions\TrainNotFoundException;
use Carbon\Carbon;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $trainNumber = 1015;
    $departure   = Carbon::create(2023, 1, 29, 18, 44);
    $vehicleGroups    = Wagenreihung::fetch($trainNumber, $departure);

    foreach($vehicleGroups as $vehicleGroup) {
        foreach($vehicleGroup->vehicles as $vehicle) {
            echo $vehicleGroup->fahrzeuggruppebezeichnung . ': ';
            echo $vehicle->fahrzeugnummer . ' (Typ: ' . $vehicle->fahrzeugtyp . ') will be in section ' . $vehicle->fahrzeugsektor . PHP_EOL;
        }
    }
} catch(TrainNotFoundException $e) {
    echo 'Train not found' . PHP_EOL;
}