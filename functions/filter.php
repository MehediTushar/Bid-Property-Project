<!-- filter_results.php -->
<?php
include 'functions/db.php';

$min_price = $_GET['min_price'] ?? 0;
$max_price = $_GET['max_price'] ?? PHP_INT_MAX;
$bedrooms = $_GET['bedrooms'] ?? '';

$query = "SELECT * FROM properties WHERE price BETWEEN ? AND ?";
$params = [$min_price, $max_price];

if ($bedrooms !== '') {
    $query .= " AND bedrooms = ?";
    $params[] = $bedrooms;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2>Filtered Results</h2>
    <?php foreach ($results as $property): ?>
        <div class="property">
            <h3><?php echo htmlspecialchars($property['title']); ?></h3>
            <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>
            <a href="property_detail.php?id=<?php echo $property['id']; ?>">View Details</a>
        </div>
    <?php endforeach; ?>
</div>
