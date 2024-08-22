<?php include('partials/header.php');
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';?>
<div class="page-wrapper">
                <div class="content container">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">User</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
									<li class="breadcrumb-item active">User</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
                    <?php if (isset($_GET['msg'])): ?>
                        <div class="alert">
                            <?php echo $_GET['msg']; ?>
                        </div>
                    <?php endif; ?>
					
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
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>User Role</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php
												$sql = "SELECT users.*, role.role_name 
                                                FROM users
                                                JOIN role ON users.role_id = role.id
                                               ";
                                                $query = $conn->prepare($sql);
                                                $query->execute();
                                                $cnt=1;
                                                while ($row = $query->fetch(PDO::FETCH_ASSOC))
													{
											?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['user_name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['role_name']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td>
                                                <?php if ($row['role_id'] != 1): ?>
                                                    <a href="userdelete.php?id=<?php echo $row['id']; ?>">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                                    <!-- <td><a href="userdelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td> -->
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
