<?php 
include 'partials/header.php'; 
// Retrieve errors and form data from the session
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Clear errors and form data after using them
unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>

<div class="container py-5">
    <div class="row">
                <div class="col-lg-6 mx-auto border shadow p-4">
                        <h2 class="text-center mb-4" ><strong> Enter Your Login Information</strong></h2>
                        <hr/>
                        <form method="post" action="functions/logining.php" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" id="email" value="" required>
                            <span class="text-danger"><?= $errors['email'] ?? '' ?></span>

                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" id="password" value=""required>
                            <span class="text-danger"><?= $errors['password'] ?? '' ?></span>

                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            
                            <div class="ofset-sm-4 col-sm-4 d-grid">
                                <button type="submit" name="login" class="btn btn-primary"> login</button>

                            </div>
                            <div class="col-sm-4 d-grid">
                                <a href="index.php" class="btn btn-outline-danger">Cancel</a>

                            </div>
                        </div>


                        </form>
                        <!-- <a href="signup_page.php" class="bg-white text-dark hover-text-dark">if you not register click here</a> -->
                        <div class="text-center dont-have">Don't have an account? <a href="signup_page.php">Register</a></div>
    
                </div>
        </div>
            
  
</div>

<?php include 'partials/footer.php'; ?>

