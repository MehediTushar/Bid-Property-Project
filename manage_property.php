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
                             <div class="page-header">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="page-title">Property</h3>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Property</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
        <div class="row">
                <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mt-0 mb-4">Property View</h4>
										<?php 
											if(isset($_GET['msg']))	
											echo $_GET['msg'];	
										?>
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <!-- <th>P ID</th> -->
                                                    <th>Title</th>
                                                    <th>Description</th>

                                                    <th>Price</th>
                                                    <th>Location</th>                                                  
													<th>User</th>
                                                    <th>Highest Bid</th>
                                                    <th>Property Type</th>
													<th>Status</th>
                                                    <th>Image</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
												<?php
                                                $sql = "
                                                SELECT properties.*, users.user_name 
                                                FROM properties
                                                JOIN users ON users.id = properties.user_id
                                               ";
                                                $query = $conn->prepare($sql);
                                                $query->execute();
                                                $cnt=1;
													while($row = $query->fetch(PDO::FETCH_ASSOC))
													{
												?>
											
                                                <tr>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php echo $row['price']; ?></td>
                                                    <td><?php echo $row['location']; ?></td>
                                                   
                                                    <td><?php echo $row['user_name']; ?></td>
                                                    <td><?php echo $row['highest_bid']; ?></td>
                                                    <td><?php echo $row['p_type']; ?></td>
													
                                                   
                                                    <td><?php echo $row['status']; ?></td>
													
                                                    
                                                    <td><?php echo $row['image']; ?></td>
													<td><a href="propertyedit.php?id=<?php echo $row['id'];?>"><button class="btn btn-info">Edit</button></a>
                                                    <a href="propertydelete.php?id=<?php echo $row['id'];?>"><button class="btn btn-danger">Delete</button></a></td>
                                                </tr>
                                               <?php
												} 
												?>
                                            </tbody>
                                        </table>
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div>
</div>
</div>



<?php include('partials/footer.php')?>