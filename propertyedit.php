<?php 
include('partials/header.php');
include 'functions/db.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$property_id = $_GET['id'];

// Fetch property details
$sql = "SELECT * FROM properties WHERE id = :id";
$query = $conn->prepare($sql);
$query->bindParam(':id', $property_id, PDO::PARAM_INT);
$query->execute();
$property = $query->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    // Handle the case where the property is not found
    echo "<p class='alert alert-warning'>Property not found!</p>";
    exit();
}

?>

<div id="page-wrapper">
    <div class="row"> 
        <div class="full-row">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-secondary double-down-line text-center">Edit Property</h2>
                    </div>
                </div>
                <div class="row p-5 bg-white">
                    <form method="post" enctype="multipart/form-data" action="functions/update_property.php">
                        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                        <div class="description">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Title</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="title" required value="<?php echo $property['title']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Description</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="description" rows="5"><?php echo $property['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Price</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="price" required value="<?php echo $property['price']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Location</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="location" required value="<?php echo $property['location']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Property Type</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" required name="p_type">
                                                <option value="">Select Type</option>
                                                <option value="apartment" <?php if($property['p_type'] == 'apartment') echo 'selected'; ?>>Apartment</option>
                                                <option value="flat" <?php if($property['p_type'] == 'flat') echo 'selected'; ?>>Flat</option>
                                                <option value="building" <?php if($property['p_type'] == 'building') echo 'selected'; ?>>Building</option>
                                                <option value="house" <?php if($property['p_type'] == 'house') echo 'selected'; ?>>House</option>
                                                <option value="villa" <?php if($property['p_type'] == 'villa') echo 'selected'; ?>>Villa</option>
                                                <option value="office" <?php if($property['p_type'] == 'office') echo 'selected'; ?>>Office</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Image</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="image">
                                            <img src="assets/images/<?php echo $property['image']; ?>" width="100" height="100">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Status</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" required name="status">
                                                <option value="">Select Status</option>
                                                <option value="1" <?php if($property['status'] == '1') echo 'selected'; ?>>Available</option>
                                                <option value="0" <?php if($property['status'] == '0') echo 'selected'; ?>>Sold Out</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-sm-4 col-sm-4 d-grid">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        <div class="col-sm-4 d-grid">
                                            <a href="/index.php" class="btn btn-outline-danger">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </div>
</div> 

<?php include('partials/footer.php')?>
