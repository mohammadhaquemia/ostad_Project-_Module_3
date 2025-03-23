<?php
require_once '../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

$manager = new VehicleManager('', '', '', '', '');
$vehicles = $manager->getVehicles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Vehicle List</h2>
        <a href="views/add.php" class="btn btn-primary mb-3">Add Vehicle</a>
        <div class="row">
            <?php foreach ($vehicles as $vehicle): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="assets/images/<?php echo $vehicle['image']; ?>" class="card-img-top" alt="Vehicle">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($vehicle['name']); ?></h5>
                            <p class="card-text"><strong>Type:</strong> <?php echo htmlspecialchars($vehicle['type']); ?></p>
                            <p class="card-text"><strong>Price:</strong> $<?php echo number_format($vehicle['price'], 2); ?></p>
                            <a href="views/edit.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="views/delete.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
