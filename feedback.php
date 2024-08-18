<?php include('partials/header.php');
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';
// $property_id = $_GET['id'];
?>
<div class="page-wrapper">
                <div class="content container">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Feedback</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Feedback</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Feedback List</h4>
									<small>Here, user can select feedbacks for displaying as testimonial. Note: Status "1" sets the feedback as testimonial.</small>
									<?php 
											if(isset($_GET['msg']))	
											echo $_GET['msg'];
											
										?>
								</div>
								<div class="card-body">

									<table id="basic-datatable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Feedback</th>
													<th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php
                                            $sql = "select testimonials.*, users.* from testimonials,users where testimonials.user_id=users.id
                                           ";
                                            $query = $conn->prepare($sql);
                                            $query->execute();
                                            $cnt=1;
												while($row = $query->fetch(PDO::FETCH_ASSOC))
													{
											?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['user_name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['rating']; ?></td>
                                                    <td><?php echo $row['comment']; ?></td>
													<td><a href="feedbackedit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-info">Edit</button></a>
                                                    <a href="feedbackdelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                                                </tr>
                                                <?php
												$cnt=$cnt+1;
												} 
												?>
                                               
                                            </tbody>
                                        </table>
								</div>
							</div>
						</div>
					</div>
				
				</div>			
			</div>
            <?php include('partials/footer.php')?>