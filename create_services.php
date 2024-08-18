<?php 
include 'partials/header.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);

?>

<div class="container py-5">
    <div class="row">
                <div class="col-lg-6 mx-auto border shadow p-4">
                        <h2 class="text-center mb-4" ><strong> Enter Service Information</strong></h2>
                        <hr/>
                        <form method="post" action="functions/service.php" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Title</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="title" id="title" value="" required>
                            <span class="text-danger"><?= isset($errors['title']) ? $errors['title'] : '' ?></span>

                            </div>
                            
                        </div>
                   
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                            <!-- <textarea name="description" placeholder="Write your description" required></textarea> -->
                            <textarea class="tinymce form-control" name="description" rows="5" cols="20"></textarea>
                            <span class="text-danger"><?= $errors['description'] ?? '' ?></span>

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
                                <button type="submit" class="btn btn-primary">Service</button>

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

