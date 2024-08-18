<?php
session_start();
include '../functions/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $property_id = $_POST['property_id'];
    $bid_amount = (double) $_POST['amount'];
    $user_id = $_SESSION['user_id']; // Fetch user ID from session

    // Fetch the current highest bid
    $bidQuery = "SELECT amount FROM bids WHERE property_id = :property_id ORDER BY amount DESC LIMIT 1";
    $stmt = $conn->prepare($bidQuery);
    $stmt->bindParam(':property_id', $property_id);
    $stmt->execute();
    $currentBid = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validate bid amount
    if (!$currentBid || $bid_amount > $currentBid['amount']) {
        try {
            // Insert the new bid
            $query = "INSERT INTO bids (property_id, user_id, amount, bid_time, created_at) VALUES (:property_id, :user_id, :amount, NOW(), NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':property_id', $property_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':amount', $bid_amount);
            $stmt->execute();

            // Update the property with the highest bid and bidder
            $updateQuery = "UPDATE properties SET highest_bid = :bid_amount, highest_bidder = :user_id WHERE id = :property_id";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':bid_amount', $bid_amount);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':property_id', $property_id);
            $stmt->execute();

            // Set success message and redirect
            $_SESSION['success_message'] = "Bid placed successfully!";
            header('Location: ../bid_process_pages.php?id=' . $property_id);
            exit();
        } catch (PDOException $e) {
            echo "Error placing bid: " . $e->getMessage();
        }
    } else {
        // Bid amount is too low
        $_SESSION['error_message'] = "Bid amount must be higher than the current highest bid.";
        header('Location: ../property_bid_view.php?id=' . $property_id);
        exit();
    }
} else {
    echo "Invalid request.";
}
?>
