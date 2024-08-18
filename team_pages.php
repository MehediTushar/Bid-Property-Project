
<?php include('partials/header.php');
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';
?>
<div class="page-wrapper">
<div class="content container">
<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Team</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="create_team.php">Create Team</a></li>
									<!-- <li class="breadcrumb-item active">Team</li> -->
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">User List</h4>
									
								</div>
								<div class="card-body">

									<table id="basic-datatable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                    <th>User Role</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php
												$sql = "SELECT *
                                                FROM teams_members
                                                
                                               ";
                                                $query = $conn->prepare($sql);
                                                $query->execute();
                                                $cnt=1;
                                                while ($row = $query->fetch(PDO::FETCH_ASSOC))
													{
											?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['contact']; ?></td>
                                                    <td><?php echo $row['role']; ?></td>
                                                    <td><img src="assets/images/team<?= htmlspecialchars($row['image']) ?>" alt="Property Image" width="100"></td>
                                                    <td><a href="teammatedelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
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
