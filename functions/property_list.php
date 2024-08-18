<?php

include '../functions/db.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and sanitize input data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = (double) $_POST['price'];
    $location = $_POST['location'];
    $p_type = $_POST['p_type'];
    $status = $_POST['status'];

    // Handle file upload
    if ($_FILES['image']['name']) {
        $targetDir = "../assets/images/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory with write permissions
        }
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $image = uniqid() . "." . $imageFileType;
        $targetFilePath = $targetDir . $image;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            try {
                // Prepare the SQL query with placeholders
                $query = "INSERT INTO properties (title, description, price, location, image, user_id, p_type, status) 
                          VALUES (:title, :description, :price, :location, :image, :user_id, :p_type, :status)";

                // Prepare and bind the values
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':location', $location);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':user_id', $_SESSION['user_id']);
                $stmt->bindParam(':p_type', $p_type);
                $stmt->bindParam(':status', $status);

                // Execute the query
                if ($stmt->execute()) {
                    // echo "Property listed successfully!";
                    $_SESSION['success_message'] = "Property listed successfully!";
                    header('Location: ../view_property.php');
            exit();
                }
            } catch (PDOException $e) {
                echo "Error inserting data: " . $e->getMessage();
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Please upload an image.";
    }
}
?>