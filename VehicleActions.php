<?php
namespace App\Classes;

require_once 'VehicleBase.php';
require_once 'VehicleActions.php';
require_once 'FileHandler.php';

class VehicleManager extends VehicleBase implements VehicleActions {
    use FileHandler;

    public function getDetails() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'price' => $this->price,
            'image' => $this->image
        ];
    }

    public function addVehicle($data) {
        $vehicles = $this->readData();
        $data['id'] = uniqid(); // Generate unique ID
        $vehicles[] = $data;
        $this->writeData($vehicles);
    }

    public function editVehicle($id, $data) {
        $vehicles = $this->readData();
        foreach ($vehicles as &$vehicle) {
            if ($vehicle['id'] === $id) {
                $vehicle = array_merge($vehicle, $data);
                break;
            }
        }
        $this->writeData($vehicles);
    }

    public function deleteVehicle($id) {
        $vehicles = $this->readData();
        $vehicles = array_filter($vehicles, fn($v) => $v['id'] !== $id);
        $this->writeData($vehicles);
    }

    public function getVehicles() {
        return $this->readData();
    }
}
?>
