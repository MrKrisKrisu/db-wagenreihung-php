<?php declare(strict_types=1);

namespace K118\DB\Models;

use K118\DB\Enum\VehicleCategory;
use K118\DB\Enum\VehicleOrientation;
use K118\DB\Enum\VehicleStatus;

class Vehicle {

    public readonly array $unparsedData;

    public readonly ?VehicleCategory    $kategorie;
    public readonly ?string             $fahrzeugnummer;
    public readonly ?VehicleOrientation $orientierung;
    public readonly ?string             $fahrzeugsektor;
    public readonly ?string             $fahrzeugtyp;
    public readonly ?string             $wagenordnungsnummer;
    public readonly ?VehicleStatus      $status;

    public function __construct(array $vehicleData) {
        $this->unparsedData        = $vehicleData;
        $this->kategorie           = VehicleCategory::tryFrom($vehicleData['kategorie']);
        $this->fahrzeugnummer      = $vehicleData['fahrzeugnummer'];
        $this->orientierung        = VehicleOrientation::tryFrom($vehicleData['orientierung']);
        $this->fahrzeugsektor      = $vehicleData['fahrzeugsektor'];
        $this->fahrzeugtyp         = $vehicleData['fahrzeugtyp'];
        $this->wagenordnungsnummer = $vehicleData['wagenordnungsnummer'];
        $this->status              = VehicleStatus::tryFrom($vehicleData['status']);
    }

}
