<?php

function getProperties($conn) {
    $stmt = $conn->query("SELECT * FROM properties WHERE status = 'for_sale' OR status = 'bidding'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPropertyDetails($conn, $propertyId) {
    $stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
    $stmt->execute([$propertyId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
