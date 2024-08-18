<!-- search_results.php -->
<?php
include 'functions/db.php';

$query = $_GET['query'];

// Perform search on properties
$stmt = $conn->prepare("SELECT * FROM properties WHERE title LIKE ? OR location LIKE ?");
$stmt->execute(['%' . $query . '%', '%' . $query . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
    <?php foreach ($results as $property): ?>
        <div class="property">
            <h3><?php echo htmlspecialchars($property['title']); ?></h3>
            <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>
            <a href="property_detail.php?id=<?php echo $property['id']; ?>">View Details</a>
        </div>
    <?php endforeach; ?>
</div>
