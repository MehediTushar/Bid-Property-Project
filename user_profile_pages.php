<?php
include('partials/header.php');
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
// session_start(); // Ensure session is started

// Get the user ID from the session
$id = $_SESSION['user_id'];

// Prepare and execute the query
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
$stmt->execute();

// Fetch the profile data
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT p.* FROM properties p JOIN bids b ON p.id = b.property_id WHERE b.id = ? ORDER BY b.amount DESC");
$stmt->execute([$id]);
$won_properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="page-wrapper">
                <div class="content container">
					
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Profile</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Profile</li>
								</ul>
							</div>
						</div>
					</div>
                    <div class="row">
                    <div class="col-md-12">
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-auto profile-image">
                <a href="#">
                    <img class="rounded-circle" alt="User Image" src="assets/images/check_user.jpg">
                </a>
            </div>
            <div class="col ml-md-n2 profile-user-info">
                <h4 class="user-name mb-2 text-uppercase"><?php echo htmlspecialchars($user['user_name']); ?></h4>
                <h6 class="text-muted"><?php echo htmlspecialchars($user['email']); ?></h6>
                <div class="user-Location"><i class="fa fa-id-badge" aria-hidden="true"></i>
                    <?php echo htmlspecialchars($user['address']); ?>
                </div>
                <div class="about-text"></div>
            </div>
        </div>
    </div>
    <div class="profile-menu">
        <ul class="nav nav-tabs nav-tabs-solid">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
            </li>
            <!-- Uncomment if needed
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
            </li>
            -->
        </ul>
    </div>
    <div class="tab-content profile-tab-cont">
        <!-- Personal Details Tab -->
        <div class="tab-pane fade show active" id="per_details_tab">
            <!-- Personal Details -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                <p class="col-sm-9"><?php echo htmlspecialchars($user['user_name']); ?></p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Address</p>
                                <p class="col-sm-9"><?php echo htmlspecialchars($user['address']); ?></p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                <p class="col-sm-9"><a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"><?php echo htmlspecialchars($user['email']); ?></a></p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                <p class="col-sm-9"><?php echo htmlspecialchars($user['phone']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <!-- Account Status -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                <span>Account Status</span>
                            </h5>
                            <button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> Active</button>
                        </div>
                    </div>
                    <!-- /Account Status -->
                </div>
            </div>
            <!-- /Personal Details -->
        </div>
    </div>
</div>

                    </div>
</div>
</div>

<?php include('partials/footer.php')?>