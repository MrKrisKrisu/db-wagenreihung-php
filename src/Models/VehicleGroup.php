<?php declare(strict_types=1);

namespace K118\DB\Models;

use Illuminate\Support\Collection;

class VehicleGroup
{

    public readonly array $unparsedData;

    public readonly ?string $fahrzeuggruppebezeichnung;
    public readonly ?string $verkehrlichezugnummer;
    public Collection $vehicles;

    public function __construct(array $vehicleGroupData)
    {
        $this->unparsedData = $vehicleGroupData;
        $this->fahrzeuggruppebezeichnung = $vehicleGroupData['fahrzeuggruppebezeichnung'] ?? null;
        $this->verkehrlichezugnummer = $vehicleGroupData['verkehrlichezugnummer'] ?? null;
        $this->vehicles = collect();
    }

}
