<?php declare(strict_types=1);

use K118\DB\Wagenreihung;
use K118\DB\Exceptions\TrainNotFoundException;
use Carbon\Carbon;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $trainNumber = 848;
    $departure   = Carbon::create(2022, 5, 29, 17, 37);
    $vehicles    = Wagenreihung::fetch($trainNumber, $departure);

    foreach($vehicles as $vehicle) {
        echo $vehicle->fahrzeugnummer . ' (Typ: ' . $vehicle->fahrzeugtyp . ') will be in section ' . $vehicle->fahrzeugsektor . PHP_EOL;
    }
} catch(TrainNotFoundException $e) {
    echo 'Train not found' . PHP_EOL;
}