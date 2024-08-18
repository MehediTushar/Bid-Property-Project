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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-4">Property View</h4>
                    <?php 
                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];    
                        }
                    ?>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                        <thead>
                            <tr>
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
                            SELECT properties.*, users.user_name, 
                                   COALESCE(MAX(bids.amount), 0) AS highest_bid 
                            FROM properties
                            JOIN users ON users.id = properties.user_id
                            LEFT JOIN bids ON bids.property_id = properties.id
                            GROUP BY properties.id
                            ";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            
                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['user_name']; ?></td>
                                <td><?php echo $row['highest_bid']; ?></td>
                                <td><?php echo $row['p_type']; ?></td>
                                <td><?php echo ($row['status'] == 1) ? 'Available' : 'Not Available'; ?></td>
                                <td><img src="<?= $base_url . 'assets/images/' . htmlspecialchars($row['image']) ?>" alt="Property Image" width="100"></td>
                                <td>
                                    <a href="propertyedit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-info">Edit</button></a>
                                    <a href="propertydelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
    </div>
</div>
<?php include('partials/footer.php'); ?>
