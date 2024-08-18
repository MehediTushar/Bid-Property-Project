<?php 

// $config = include('config/config.php');

$config = include(__DIR__ . '/../config/config.php');
// if (!$config) {
//     die("Failed to load configuration.");
// }
try {
    $dsn = "mysql:host={$config['db_host']};port={$config['db_port']};dbname={$config['db_name']}";
    
    // Create a new PDO instance
    $conn = new PDO($dsn, $config['db_user'], $config['db_pass']);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Database connection successful!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>
