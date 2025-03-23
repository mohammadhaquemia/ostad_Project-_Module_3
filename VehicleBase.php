<?php
namespace App\Classes;

abstract class VehicleBase {
    protected $id;
    protected $name;
    protected $type;
    protected $price;
    protected $image;

    public function __construct($id, $name, $type, $price, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->image = $image;
    }

    abstract public function getDetails();
}
?>
