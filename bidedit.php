<?php 
include('partials/header.php');
include 'functions/db.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid bid ID.";
    exit();
}

$bid_id = (int) $_GET['id'];

// Fetch the bid details
$query = "SELECT b.*, p.title FROM bids b LEFT JOIN properties p ON b.property_id = p.id WHERE b.id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $bid_id);
$stmt->execute();
$bid = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$bid) {
    echo "Bid not found.";
    exit();
}
?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4"><strong>Edit Your Bid</strong></h2>
            <hr/>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data" action="functions/bid_update.php">
                <div class="mb-3">
                    <label for="property" class="form-label">Property</label>
                    <input type="text" class="form-control" id="property" value="<?php echo htmlspecialchars($bid['title']); ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Bid Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo htmlspecialchars($bid['amount']); ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Bid</button>
                    <a href="bid_property.php" class="btn btn-outline-danger mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>