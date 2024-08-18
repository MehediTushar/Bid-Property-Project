<?php 
include 'partials/header.php'; 
include 'functions/db.php'; 
include 'functions/property.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$properties = getProperties($conn);
?>

<div class="container mt-5">
    <h2>Available Properties</h2>
    <div class="row">
        <?php foreach ($properties as $property) { ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="../assets/images/<?php echo $property['image']; ?>" class="card-img-top" alt="<?php echo $property['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $property['name']; ?></h5>
                    <p class="card-text"><?php echo $property['description']; ?></p>
                    <p class="card-text">Highest Bid: <?php echo $property['highest_bid']; ?></p>
                    <p class="card-text">Price: <?php echo $property['price']; ?></p>
                    <a href="bid_process_page.php?id=<?php echo $property['id']; ?>" class="btn btn-primary">Bid Now</a>
                    <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-secondary">View Details</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

