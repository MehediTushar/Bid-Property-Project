<?php
include '../functions/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $p_type = $_POST['p_type'];
    $status = $_POST['status'];
    
    // Check if an image is uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        
        $sql = "UPDATE properties SET title = :title, description = :description, price = :price, location = :location, p_type = :p_type, image = :image, status = :status WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
    } else {
        $sql = "UPDATE properties SET title = :title, description = :description, price = :price, location = :location, p_type = :p_type, status = :status WHERE id = :id";
        $query = $conn->prepare($sql);
    }
    
    // Bind parameters
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':location', $location, PDO::PARAM_STR);
    $query->bindParam(':p_type', $p_type, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':id', $property_id, PDO::PARAM_INT);
    
    // Execute query
    if ($query->execute()) {
        $msg = "Property updated successfully";
    } else {
        $msg = "Failed to update property";
    }

    header("Location: ../view_property.php?msg=" . urlencode($msg));
    exit();
}
?>
