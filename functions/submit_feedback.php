<?php
session_start();
include '../functions/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    try {
        // Debugging: Print submitted values
        echo "Property ID: " . htmlspecialchars($property_id) . "<br>";
        echo "User ID: " . htmlspecialchars($user_id) . "<br>";
        echo "Rating: " . htmlspecialchars($rating) . "<br>";
        echo "Comments: " . htmlspecialchars($comments) . "<br>";

        // Check if the property_id exists in the properties table
        $checkPropertyQuery = "SELECT COUNT(*) FROM properties WHERE id = :property_id";
        $stmt = $conn->prepare($checkPropertyQuery);
        $stmt->bindParam(':property_id', $property_id, PDO::PARAM_INT);
        $stmt->execute();
        $propertyExists = $stmt->fetchColumn();

        if ($propertyExists) {
            // Insert feedback into the database
            $query = "INSERT INTO testimonials (property_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$property_id, $user_id, $rating, $comments]);

            $_SESSION['success_message'] = "Feedback submitted successfully!";
            header('Location: ../fedback_form.php?id=' . $property_id);
            exit();
        } else {
            // Handle the error when property does not exist
            $_SESSION['error_message'] = "The specified property does not exist.";
            header('Location: ../create_feedback.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Error rating : " . $e->getMessage();
    }
}
?>
