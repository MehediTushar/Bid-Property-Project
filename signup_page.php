<?php 
include 'partials/header.php'; 

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);

?>

<div class="container py-5">
    <div class="row">
                <div class="col-lg-6 mx-auto border shadow p-4">
                        <h2 class="text-center mb-4" ><strong> Enter Your Information</strong></h2>
                        <hr/>
                        <form method="post" action="functions/signup.php" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">User Name</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="user_name" id="user_name" value="" required>
                            <span class="text-danger"><?= isset($errors['user_name']) ? $errors['user_name'] : '' ?></span>

                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" id="email" value="" required>
                            <span class="text-danger"><?= isset($errors['user_name']) ? $errors['user_name'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                            <input type="number" class="form-control" name="phone" id="phone" value="" required>
                            <span class="text-danger"> <?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>

                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" id="password" value="" required>
                            <span class="text-danger"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="" required>
                            <span class="text-danger"><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                            <input class="form-control" name="address" id="address" value="" required>
                            <span class="text-danger"><?= isset($errors['address']) ? $errors['address'] : '' ?></span>

                            </div>
                            
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">User Type</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="role_id" id="role_id" required>
                                <option value="" disabled selected>Select Your Role</option>
                                <option value="2">Bidder</option>
                                <option value="3">Property Owner</option>
                            </select>
                            <span class="text-danger"><?= isset($errors['role_id']) ? $errors['role_id'] : '' ?></span>
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
                
                        <div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
    
                </div>
        </div>
            
  
</div>

<?php include 'partials/footer.php'; ?>

