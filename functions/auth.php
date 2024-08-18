<?php

function isAdmin() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1;
}

function isBidder() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2;
}

function isPropertyOwner() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] ===3;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect if not logged in
function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

?>