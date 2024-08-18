<?php
session_start();
include '../functions/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate Password Length
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    // If there are errors, store them and redirect
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../login.php');
        exit();
    }

    try {
        // Check if user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $_SESSION['errors']['email'] = 'Email ID Not Found';
            header('Location: ../login.php');
            exit();
        }

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = (int)$user['role_id'];
          
            $_SESSION['success_message'] = "Login successful!";
            
            header('Location: ../home.php');
            exit();
        } else {
            $_SESSION['errors']['credentials'] = "Invalid email or password.";
            header('Location: ../login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['errors']['db'] = "Database error: " . $e->getMessage();
        $_SESSION['form_data'] = $_POST; // Save form data
        header('Location: ../login.php');
        exit();
    }
}
?>
