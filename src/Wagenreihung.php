<?php declare(strict_types=1);

namespace K118\DB;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use K118\DB\Exceptions\TrainNotFoundException;
use K118\DB\Models\Vehicle;
use K118\DB\Models\VehicleGroup;

abstract class Wagenreihung {

    /**
     * @throws GuzzleException
     * @throws TrainNotFoundException
     */
    public static function fetch(int $trainNumber, Carbon $departure, int $timeout = 5) {
        try {
            $client   = new Client();
            $response = $client->get(
                strtr('https://www.apps-bahn.de/wr/wagenreihung/1.0/:train/:departure', [
                    ':train'     => $trainNumber,
                    ':departure' => $departure->format('YmdHi'),
                ]),
                [
                    'headers' => [
                        'User-Agent' => 'db-wagenreihung-php/1.0 (+https://github.com/mrkriskrisu/db-wagenreihung-php)',
                    ],
                    'timeout' => $timeout,
                ]
            );
            $json     = json_decode($response->getBody()->getContents(), true);
            $vehicleGroups = collect();

            foreach($json['data']['istformation']['allFahrzeuggruppe'] as $vehicleGroupRaw) {
                $vehicleGroup = new VehicleGroup($vehicleGroupRaw);
                $vehicleGroups->push($vehicleGroup);
                foreach($vehicleGroupRaw['allFahrzeug'] as $vehicle) {
                    $vehicleGroup->vehicles->push(new Vehicle($vehicle));
                }
            }

            return $vehicleGroups;
        } catch(ClientException $exception) {
            if($exception->getCode() === 404) {
                throw new TrainNotFoundException();
            }
        }
    }
}