<?php 
include '../functions/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];

    // Validate bid amount
    if ($amount <= 0) {
        $error = "Please enter a valid bid amount.";
    } else {
        // Update the bid in the database
        $query = "UPDATE bids SET amount = :amount WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':id', $bid_id);

        if ($stmt->execute()) {
            header("Location: ../bid_process_pages?msg=Bid updated successfully.");
            exit();
        } else {
            $error = "Failed to update the bid. Please try again.";
        }
    }
}
?>