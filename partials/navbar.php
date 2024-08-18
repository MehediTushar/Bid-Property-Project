<?php
include 'functions/auth.php'; 

$base_url = '/property_bid_project/';
$isLoggedIn = isLoggedIn();
$isAdmin = isAdmin();
$isBidder = isBidder();
$isPropertyOwner = isPropertyOwner();
// $property_id = isset($_SESSION['property_id']) ? $_SESSION['property_id'] : null;


?>
<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">
    <img src="<?php echo $base_url; ?>assets/images/home.JPG" alt="Home" width="30" height="30" class="d-inline-block align-top"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="asset_property.php">Property</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="assets_bid.php">Bid Process</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="asset_service.php">Service</a>
        </li>
      </ul>

      <?php if($isLoggedIn): ?>

        <?php if($isAdmin): ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="manage_users.php">Manage Users</a>
                <a class="dropdown-item" href="manage_bid.php">Oversee Bids</a>
                <a class="dropdown-item" href="manage_property.php">Property</a>
                <a class="dropdown-item" href="feedback.php">Manage Feedback</a>
                <a class="dropdown-item" href="team_pages.php">Manage Team</a>
                <a class="dropdown-item" href="service_pages.php">Manage Service</a>
              </div>
            </li>
          </ul>
          
        <?php elseif($isBidder): ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Bidder</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="property_bid_view.php">View Property Details</a>
                <a class="dropdown-item" href="bid_process_pages.php">Bid</a>
                <a class="dropdown-item" href="create_feedback.php">Feedback</a>
              </div>
            </li>
          </ul>
          
        <?php elseif($isPropertyOwner): ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Property Owner</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="list_property.php">List Property</a>
                <a class="dropdown-item" href="view_property.php">View Property</a>
                <a class="dropdown-item" href="monitor_bid.php">Monitor Bids</a>
              </div>
            </li>
          </ul>
          
        <?php endif; ?>

        <!-- Common Dashboard for All Roles -->
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dashboard</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="user_profile_pages.php">Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
        </ul>

      <?php else: ?>
      <!-- If not logged in -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Manage Rentals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Sign In</a>
        </li>
      </ul>
      <?php endif; ?>
    </div>
  </div>
</nav>
