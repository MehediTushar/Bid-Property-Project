<?php
include 'functions/db.php';
include('partials/header.php'); // Ensure header includes required resources

// Initialize variables with default values
$type = '';
$status = '';
$location = '';

// Check if the form is submitted
if (isset($_POST['filter'])) {
    // Retrieve form data and sanitize it
    $type = isset($_POST['p_type']) ? $_POST['p_type'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';

    // Debugging output


    // Prepare SQL query
    $query = "SELECT * FROM properties WHERE 1";

    if (!empty($type)) {
        $query .= " AND p_type = :type";
    }
    if (!empty($status)) {
        $query .= " AND status = :status";
    }
    if (!empty($location)) {
        $query .= " AND location LIKE :location";
    }

    // Debugging the query

    try {
        $stmt = $conn->prepare($query);

        if (!empty($type)) {
            $stmt->bindParam(':type', $type);
        }
        if (!empty($status)) {
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        }
        if (!empty($location)) {
            $location = "%$location%";
            $stmt->bindParam(':location', $location);
        }

        $stmt->execute();

        // Check for SQL errors
        if ($stmt->errorCode() != '00000') {
            $error = $stmt->errorInfo();
            echo "SQL Error: " . $error[2] . "<br>";
        }

        $properties = $stmt->fetchAll();

        // Debugging the results
        // echo "Number of properties found: " . count($properties) . "<br>";

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<div class="container">
    <h2>Filtered Properties</h2>
    <?php if (isset($properties) && $properties): ?>
        <?php foreach ($properties as $property): ?>
            <div class="property-card mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <img src="assets/images/<?= htmlspecialchars($property['image']) ?>" alt="Property Image" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h3><?= htmlspecialchars($property['title']) ?></h3>
                        <p><?= htmlspecialchars($property['description']) ?></p>
                        <table class="table table-bordered">
                            <tr>
                                <th>Price</th>
                                <td>$<?= htmlspecialchars($property['price']) ?></td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td><?= htmlspecialchars($property['location']) ?></td>
                            </tr>
                            <tr>
                                <th>Property Type</th>
                                <td><?= htmlspecialchars($property['p_type']) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?= ($property['status'] == 1) ? 'Available' : 'Not Available' ?></td>
                            </tr>
                        </table>
                        <!-- <a href="propertydetail.php?id=<?= htmlspecialchars($property['id']) ?>" class="btn btn-primary">View Details</a> -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No properties match your criteria.</p>
    <?php endif; ?>
</div>

<?php include('partials/footer.php'); ?>
