<?php
include '../functions/db.php'; // Database connection

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $role = trim($_POST['role']);

   
    // Validate input
    $errors = [];

    if (empty($name)) {
        $errors['name'] = "name is required.";
    }
    
    
    if (empty($contact) || strlen($contact) < 10 || strlen($contact) > 13) {
        $errors['contact'] = "Valid contact number is required (between 10 to 13 digits).";
    }
    
    if (empty($role)) {
        $errors['role'] = "Role is required.";
    }

    


    // Check if there are any errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../create_team.php'); // Redirect back to form page
        exit();
    } 

    if ($_FILES['image']['name']) {
        $targetDir = "../assets/images/team";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory with write permissions
        }
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $image = uniqid() . "." . $imageFileType;
        $targetFilePath = $targetDir . $image;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            try {
                // Prepare the SQL query with placeholders
                $query = "INSERT INTO teams_members (name, contact, role,image) 
                          VALUES (:name, :contact, :role, :image)";

                // Prepare and bind the values
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':contact', $contact);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':image', $image);

                // Execute the query
                if ($stmt->execute()) {
                    // echo "Property listed successfully!";
                    $_SESSION['success_message'] = "Team Created successfully!";
                    header('Location: ../team_pages.php');
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
