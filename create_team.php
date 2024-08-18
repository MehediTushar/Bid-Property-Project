<?php 
include 'partials/header.php'; 

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
?>

<div class="container py-5">
    <div class="row">
                <div class="col-lg-6 mx-auto border shadow p-4">
                        <h2 class="text-center mb-4" ><strong> Enter Team Information</strong></h2>
                        <hr/>
                        <form method="post" action="functions/team.php" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="name" value="" required>
                            <span class="text-danger"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Contact</label>
                            <div class="col-sm-8">
                            <input type="number" class="form-control" name="contact" id="contact" value="" required>
                            <span class="text-danger"><?= isset($errors['contact']) ? $errors['contact'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Role Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="role" id="role" value="" required>
                            <span class="text-danger"><?= isset($errors['role']) ? $errors['role'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Image</label>
                            <div class="col-sm-8">
                            <input type="file" class="form-control" name="image" required >
                            <span class="text-danger"><?= isset($errors['image']) ? $errors['image'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            
                            <div class="ofset-sm-4 col-sm-4 d-grid">
                                <button type="submit" class="btn btn-primary">Sign Up</button>

                            </div>
                            <div class="col-sm-4 d-grid">
                                <a href="/index.php" class="btn btn-outline-danger">Cancel</a>

                            </div>
                        </div>


                        </form>
                
                        
    
                </div>
        </div>
            
  
</div>

<?php include 'partials/footer.php'; ?>

