<?php
include '../functions/db.php'; // Database connection

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = trim($_POST['address']);
    $role_id = $_POST['role_id'];

   
    // Validate input
    $errors = [];

    if (empty($username)) {
        $errors['user_name'] = "Username is required.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    
    if (empty($phone) || strlen($phone) < 10 || strlen($phone) > 13) {
        $errors['phone'] = "Valid phone number is required (between 10 to 13 digits).";
    }

    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }
    
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }

    


    // Check if there are any errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../signup_page.php'); // Redirect back to form page
        exit();
    } else {
        try{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // echo "<p class='alert alert-warning'>Email ID already exists</p>";
            $_SESSION['errors'] = ['email' => 'Email ID already exists'];
                header('Location: ../signup_page.php'); // Redirect back to form page
                exit();
        }else{

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL query
            $sql = "INSERT INTO users (user_name, email, phone, password, address, role_id) VALUES (:user_name, :email, :phone, :password, :address, :role_id)";
            $stmt = $conn->prepare($sql);

            // Bind parameters and execute the statement
            $stmt->execute([
                'user_name' => $username,
                'email' => $email,
                'phone' => $phone,
                'password' => $hashed_password,
                'address' => $address,
                'role_id' => $role_id
            ]);

            // header('Location: ../login.php');
            // exit();
            // Set success message and redirect to a new page
            $_SESSION['success_message'] = "Registration successful! Redirecting to the login page...";
            header('Location: ../login.php');
            exit();


            
    }
   

        }
        catch(PDOException $e){
            echo "<p class='alert alert-danger'>Error: " . $e->getMessage() . "</p>";

        }
       
    }
}
?>
