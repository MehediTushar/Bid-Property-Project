<?php include('partials/header.php');
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';?>

<div id="page-wrapper">
    <div class="row "> 
    
        <div class="full-row">
            <div class="container py-5">
                    <div class="row">
						<div class="col-lg-12">
							<h2 class="text-secondary double-down-line text-center">List Property</h2>
                        </div>
					</div>
                    <div class="row p-5 bg-white">
                        <form method="post" enctype="multipart/form-data" action="functions/property_list.php">
								<div class="description">
						
										<div class="row">
											
											<div class="col-xl-6">
                                            <div class="form-group row">
													<label class="col-lg-3 col-form-label">Title</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="title" required placeholder="Enter Title">
													</div>
												</div><!-- FOR MORE PROJECTS visit: codeastro.com -->
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Description</label>
													<div class="col-lg-9">
														<textarea class="tinymce form-control" name="description" rows="5" cols="20"></textarea>
													</div>
												</div>
                                            <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Price:</label>
                                                    <div class="col-lg-9">
														<input type="text" class="form-control" name="price" required >
													</div>
                                                   
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Location:</label>
                                                    <div class="col-lg-9">
														<input type="text" class="form-control" name="location" required >
													</div>
                                                   
                                                </div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Property Type</label>
													<div class="col-lg-9">
														<select class="form-control" required name="p_type">
															<option value="">Select Type</option>
															<option value="apartment">Apartment</option>
															<option value="flat">Flat</option>
															<option value="building">Building</option>
															<option value="house">House</option>
															<option value="villa">Villa</option>
															<option value="office">Office</option>
														</select>
													</div>
												</div>

                                            
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Image</label>
													<div class="col-lg-9">
														<input type="file" class="form-control" name="image" required >
													</div>
												</div>
                                                <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Status</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control"  required name="status">
                                                        <option value="">Select Status</option>
                                                        <option value="1">Available</option>
                                                        <option value="0">Sold Out</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                            
                                            <div class="ofset-sm-4 col-sm-4 d-grid">
                                                <button type="submit" class="btn btn-primary">Submit</button>

                                            </div>
                                            <div class="col-sm-4 d-grid">
                                                <a href="/index.php" class="btn btn-outline-danger">Cancel</a>

                                            </div>
                                        </div>
												 
										</div>
                                            
                                            

											<!-- <input type="submit" value="Submit Property" class="btn btn-info"name="add" style="margin-left:200px;"> -->
										
								</div>
								</form>
                    </div>            
            </div>
        </div>
</div>
</div> 
<?php include('partials/footer.php')?>