<?php
include '../functions/db.php'; // Database connection

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
  
    // Validate input
    $errors = [];

    if (empty($title)) {
        $errors['title'] = "title is required.";
    }
    
    
    if (empty($description)) {
        $errors['description'] = "description is required.";
    }

    


    // Check if there are any errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../create_services.php'); // Redirect back to form page
        exit();
    } 

    if ($_FILES['image']['name']) {
        $targetDir = "../assets/images/service";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory with write permissions
        }
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $image = uniqid() . "." . $imageFileType;
        $targetFilePath = $targetDir . $image;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            try {
                // Prepare the SQL query with placeholders
                $query = "INSERT INTO services (title, description,image) 
                          VALUES (:title, :description, :image)";

                // Prepare and bind the values
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image', $image);

                // Execute the query
                if ($stmt->execute()) {
                    // echo "Property listed successfully!";
                    $_SESSION['success_message'] = "service Created successfully!";
                    header('Location: ../service_pages.php');
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
