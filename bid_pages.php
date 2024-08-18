<?php 

include('partials/header.php');
include 'functions/db.php';
$base_url = '/property_bid_project/';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $property_id = (int) $_GET['id'];

    // Fetch property details
    $query = "SELECT * FROM properties WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $property_id);
    $stmt->execute();
    $property = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$property) {
        echo "Property not found.";
        exit();
    }
}
?>
<div class="container py-5">
    <div class="row">
                <div class="col-lg-6 mx-auto border shadow p-4">
                        <h2 class="text-center mb-4" ><strong> Enter Your Login Information</strong></h2>
                        <hr/>
                        <?php if (isset($_SESSION['user_id'])): ?>
    <form action="functions/place_bid.php" method="post">
        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">

        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Bid Amount</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="amount" id="amount" value="" required>
                            <span class="text-danger"><?= $errors['amount'] ?? '' ?></span>

                            </div>
                            
        </div>
        <div class="row mb-3">
                            
                            <div class="ofset-sm-4 col-sm-4 d-grid">
                                <button type="submit" name="place_bid" class="btn btn-primary">Place Bid</button>

                            </div>
                            <div class="col-sm-4 d-grid">
                                <a href="index.php" class="btn btn-outline-danger">Cancel</a>

                            </div>
                        </div>

    </form>
<?php else: ?>
    <p>Please <a href="login.php">log in</a> to place a bid.</p>
<?php endif; ?>
</div>
</div>


<?php include('partials/footer.php'); ?>