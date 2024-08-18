<?php
// feedback_form.php
include('partials/header.php');
include 'functions/db.php';
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
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
    <form action="functions/submit_feedback.php" method="post">
        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">

        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Rating</label>
                            <div class="col-sm-8">
                            <select name="rating">
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                            <span class="text-danger"><?= $errors['rating'] ?? '' ?></span>

                            </div>
                            
        </div>
        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Review</label>
                            <div class="col-sm-8">
                            <textarea name="comment" placeholder="Write your review" required></textarea>
                            <span class="text-danger"><?= $errors['comment'] ?? '' ?></span>

                            </div>
                            
        </div>
        <div class="row mb-3">
                            
                            <div class="ofset-sm-4 col-sm-4 d-grid">
                                <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>

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
<?php include 'partials/footer.php'; ?>



