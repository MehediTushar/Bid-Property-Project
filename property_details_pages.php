<?php
include('partials/header.php');
include 'functions/db.php';
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';

if (isset($_GET['id'])) 
{
    $property_id = $_GET['id'];

    // Fetch property details
    $query = "SELECT * FROM properties WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $property_id);
    $stmt->execute();
    $property = $stmt->fetch();

    // Fetch bidding details
    $bidQuery = "SELECT bids.amount, users.user_name, users.email 
                 FROM bids 
                 JOIN users ON bids.user_id = users.id 
                 WHERE bids.property_id = :property_id 
                 ORDER BY bids.amount DESC LIMIT 1";
    $bidStmt = $conn->prepare($bidQuery);
    $bidStmt->bindParam(':property_id', $property_id);
    $bidStmt->execute();
    $highestBid = $bidStmt->fetch();
} else {
    echo "Property not found.";
    exit();
}
?>
 <div class="container">
 <h3>Bidding Information</h3>
        <table class="table table-bordered bidding-info">
            <?php if ($highestBid): ?>
                <tr>
                    <th>Current Highest Bid</th>
                    <td><?= htmlspecialchars($highestBid['amount']) ?></td>
                </tr>
                <tr>
                    <th>Bidder Name</th>
                    <td><?= htmlspecialchars($highestBid['name']) ?></td>
                </tr>
                <tr>
                    <th>Bidder Email</th>
                    <td><?= htmlspecialchars($highestBid['email']) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="2">No bids placed yet.</td>
                </tr>
            <?php endif; ?>
        </table>
        <h2>Property Details</h2>
        <table class="table table-bordered property-details">
            <tr>
                <th>Title</th>
                <td><?= htmlspecialchars($property['title']) ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?= htmlspecialchars($property['description']) ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?= htmlspecialchars($property['price']) ?></td>
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
            <tr>
                <th>Image</th>
                <td><img src="assets/images/<?= htmlspecialchars($property['image']) ?>" alt="Property Image" width="300"></td>
            </tr>
        </table>

        
    </div>
    
<?php include('partials/footer.php'); ?>