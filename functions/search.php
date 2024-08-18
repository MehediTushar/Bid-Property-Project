<!-- search_form.php -->
<?php
include('functions/db.php'); // Include your database connection

// Initialize variables
$type = isset($_POST['type']) ? $_POST['type'] : '';
$stype = isset($_POST['stype']) ? $_POST['stype'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';

// Build SQL query
$sql = "SELECT properties.*, users.user_name, role.role_name 
        FROM properties
        JOIN users ON properties.user_id = users.id 
        JOIN role ON users.role_id = role.id 
        WHERE 1=1";

if ($type) {
    $sql .= " AND properties.p_type = :type";
}
if ($stype) {
    $sql .= " AND properties.status = :stype";
}
if ($city) {
    $sql .= " AND properties.location LIKE :city";
}

$sql .= " ORDER BY properties.created_at DESC LIMIT 9";

$query = $conn->prepare($sql);

if ($type) {
    $query->bindParam(':type', $type);
}
if ($stype) {
    $query->bindParam(':stype', $stype);
}
if ($city) {
    $query->bindValue(':city', "%$city%");
}

$query->execute();
?>

