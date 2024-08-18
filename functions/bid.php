<?php

function placeBid($conn, $propertyId, $bidAmount) {
    // Fetch current highest bid for the property
    $stmt = $conn->prepare("SELECT highest_bid FROM properties WHERE id = ?");
    $stmt->execute([$propertyId]);
    $property = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the new bid is higher than the current bid
    if ($bidAmount > $property['highest_bid']) {
        // Update the highest bid
        $stmt = $conn->prepare("UPDATE properties SET highest_bid = ? WHERE id = ?");
        $stmt->execute([$bidAmount, $propertyId]);

        return true;  // Bid placed successfully
    } else {
        return false; // Bid not high enough
    }
}
