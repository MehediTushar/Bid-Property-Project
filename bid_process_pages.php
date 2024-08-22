
<?php include('partials/header.php');
include 'functions/db.php'; 
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
$base_url = '/property_bid_project/';
$id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT p.* FROM properties p JOIN bids b ON p.id = b.property_id WHERE b.id = ? ORDER BY b.amount DESC");
$stmt->execute([$id]);
$won_properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <h2>Properties You Won</h2>
    <?php foreach ($won_properties as $property): ?>
        <div class="property">
            <h3><?php echo htmlspecialchars($property['title']); ?></h3>
            <img src="images/<?php echo htmlspecialchars($property['image']); ?>" alt="<?php echo htmlspecialchars($property['title']); ?>">
            <p>Price: $<?php echo htmlspecialchars($property['price']); ?></p>
            <p>Location: <?php echo htmlspecialchars($property['location']); ?></p>
        </div>
    <?php endforeach; ?>
</div>
<div class="page-wrapper">
<div class="content container">
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mt-0 mb-4">Bid Property</h4>
										<?php 
											if(isset($_GET['msg']))	
											echo $_GET['msg'];	
										?>
                                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <!-- <th>P ID</th> -->
                                                    <th>User</th>
                                                    <th>Property</th>
                                                    <th>Amount</th>
                                                    <th>Bid Time</th>                                                                          
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
												<?php
                                                $sql = "
                                                SELECT bids.*, users.user_name,users.email, properties.title, properties.location
                                                FROM `bids`
                                                LEFT JOIN users ON users.id = bids.user_id
                                                LEFT JOIN `properties` ON properties.id=bids.property_id
                                               ";
                                                $query = $conn->prepare($sql);
                                                $query->execute();
                                                $cnt=1;
													while($row = $query->fetch(PDO::FETCH_ASSOC))
													{
												?>
											
                                                <tr>
                                                    <td><?php echo $row['user_name']; ?></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['amount']; ?></td>
                                                    <td><?php echo $row['bid_time']; ?></td>
                                                    <td>
                                                    <a href="bidedit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-info">Edit</button></a>    
                                                    <a href="biddelete.php?id=<?php echo $row['id'];?>"><button class="btn btn-danger">Delete</button></a></td>
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
</div>



<?php include('partials/footer.php')?>