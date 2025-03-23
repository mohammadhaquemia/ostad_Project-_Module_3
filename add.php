<?php
require_once '../../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manager = new VehicleManager('', '', '', '', '');
    $manager->addVehicle($_POST);
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Add Vehicle</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Type:</label>
                <input type="text" class="form-control" name="type" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price:</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image Name:</label>
                <input type="text" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-success">Add Vehicle</button>
        </form>
    </div>
</body>
</html>
