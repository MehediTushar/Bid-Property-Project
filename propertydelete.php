<?php
// if (!isset($_SESSION['user_id'])) {
//     // Redirect to the login page if the user is not logged in
//     header('Location: login.php');
//     exit();
// }
include 'functions/db.php'; 
$id = $_GET['id'];

$msg="";
$sql = "DELETE FROM properties WHERE id = :id";
$result = $conn->prepare($sql);

// Bind the parameters
$result->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the query
if ($result->execute()) {
    $msg = "<p class='alert alert-success'>Property Deleted</p>";
} else {
    $msg = "<p class='alert alert-warning'>Property not Deleted</p>";
}
header("Location: view_property.php?msg=" . urlencode($msg));
exit();
?>