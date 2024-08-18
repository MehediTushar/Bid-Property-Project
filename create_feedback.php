<?php
include 'partials/header.php';
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';

// Fetch all properties with the highest bid information
$query = "
    SELECT p.*, 
           (SELECT amount FROM bids WHERE property_id = p.id ORDER BY amount DESC LIMIT 1) AS highest_bid_amount,
           (SELECT user_id FROM bids WHERE property_id = p.id ORDER BY amount DESC LIMIT 1) AS highest_bidder_id
    FROM properties p
";
$stmt = $conn->prepare($query);
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>Bidder Dashboard</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Location</th>
                <th>Property Type</th>
                <th>Status</th>
                <th>Image</th>
                <th>Bidding Information</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($properties as $property): ?>
            <tr>
                <td><?php echo htmlspecialchars($property['title']); ?></td>
                <td><?php echo htmlspecialchars($property['description']); ?></td>
                <td><?php echo htmlspecialchars($property['price']); ?></td>
                <td><?php echo htmlspecialchars($property['location']); ?></td>
                <td><?php echo htmlspecialchars($property['p_type']); ?></td>
                <td><?php echo ($property['status'] == 1) ? 'Available' : 'Not Available'; ?></td>
                <td><img src="assets/images/<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image" width="100"></td>
                <td>
                    <?php if ($property['highest_bid_amount']): ?>
                        <p><strong>Current Highest Bid:</strong> <?= htmlspecialchars($property['highest_bid_amount']) ?></p>
                        <p><strong>Highest Bidder ID:</strong> <?= htmlspecialchars($property['highest_bidder_id']) ?></p>
                    <?php else: ?>
                        <p>No bids placed yet.</p>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($property['status'] == 1): ?>
                        <a href="fedback_form.php?id=<?php echo $property['id']; ?>" class="btn btn-primary">Feedback</a>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>Not Available</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php'; ?>
