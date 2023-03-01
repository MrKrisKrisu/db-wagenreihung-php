# DB Wagenreihung Client for PHP

[![Gitmoji](https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg)](https://gitmoji.dev)
![License](https://img.shields.io/github/license/MrKrisKrisu/hafas-client-php)

This repository provides a PHP package for fetching the current composition of a German train (Wagenreihung). The
package uses the API provided by Deutsche Bahn.

> :warning: This library is just being developed and structured. With each version the structure will change. So use
> this library with care and specify an exact version in your composer.json (don't use <b>^</b>0.x!) until it reaches
> version 1.

## Installation

You can install the package via Composer:

```bash
composer require mrkriskrisu/db-wagenreihung-php
```

## Usage

```php
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
```