<?php
namespace App\Classes;

trait FileHandler {
    private $file = __DIR__ . '/../../data/vehicles.json';

    // Read from JSON file
    public function readData() {
        if (!file_exists($this->file)) {
            return [];
        }
        return json_decode(file_get_contents($this->file), true) ?? [];
    }

    // Write to JSON file
    public function writeData($data) {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
?>
