<?php include('partials/header.php')?>
<?php include('partials/hero_sec.php')?>
<?php include('functions/db.php')?>


 
			
        <div class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-secondary double-down-line text-center mb-4">Recent Property</h2>
            </div>
            <div class="col-md-12">
                <div class="tab-content mt-4" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home">
                        <div class="row">
                        
                            <?php 
                                $sql = "
                                SELECT properties.*, users.user_name, role.role_name 
                                FROM properties
                                JOIN users ON properties.user_id = users.id 
                                JOIN role ON users.role_id = role.id 
                                ORDER BY CREATED_AT DESC LIMIT 9";
                                $query = $conn->prepare($sql);
                                $query->execute();
                                $cnt = 1;

                                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    if($cnt % 3 == 1 && $cnt != 1) {
                                        // Close previous row and start a new one after every 3 items
                                        echo '</div><div class="row">';
                                    }
                            ?>
                            
                            <div class="col-md-6 col-lg-4">
                                <div class="featured-thumb hover-zoomer mb-4">
                                    <div class="overlay-black overflow-hidden position-relative"> 
                                        <img src="assets/images/<?= htmlspecialchars($row['image']) ?>" alt="Property Image" >
                                        <div class="featured bg-success text-white">New</div>
                                        <div class="sale bg-success text-white text-capitalize">For <?php echo $row['title'];?></div>
                                        <div class="price text-primary"><b>$<?php echo $row['price'];?></b></div>
                                    </div>
                                    <div class="featured-thumb-data shadow-one">
                                        <div class="p-3">
                                            <h5 class="text-secondary hover-text-success mb-2 text-capitalize">
                                                <a href="#"><?php echo $row['p_type']; ?></a>
                                            </h5>
                                            <span class="location text-capitalize">
                                                <i class="fas fa-map-marker-alt text-success"></i> 
                                                <?php echo $row['location']; ?>
                                            </span>
                                        </div>

                                        <div class="p-4 d-inline-block w-100">
                                            <div class="float-left text-capitalize">
                                                <i class="fas fa-user text-success mr-1"></i>
                                                By: <?php echo $row['user_name']; ?>
                                            </div>
                                            <div class="float-right">
                                                <i class="far fa-calendar-alt text-success mr-1"></i>
                                                <?php echo date('d-m-Y', strtotime($row['created_at'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                                $cnt++; 
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 <!-- About-->
 <section class="page-section" id="property">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Property</h2>
            <h3 class="section-subheading text-muted">All Properties </h3>
        </div>
        <div class="row">
            <?php 
                $sql = "SELECT * FROM properties ORDER BY CREATED_AT DESC";
                $query = $conn->prepare($sql);
                $query->execute();
                $cnt = 1;
                
                while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
                    if($cnt % 3 == 1 && $cnt != 1) {
                        // Close previous row and start a new one after every 3 items
                        echo '</div><div class="row">';
                    }
            ?>
            <div class="col-md-4">
                <div class="timeline-image">
                    <img class="rounded-circle img-fluid" src="assets/images/<?= htmlspecialchars($row['image']) ?>" alt="..." />
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></h4>
                        <h4 class="subheading"><?php echo $row['title']; ?></h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted"><?php echo $row['description']; ?></p>
                    </div>
                </div>
            </div>
            <?php 
                $cnt++;
                } 
            ?>
        </div>
    </div>
</section>

<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <div class="row">
        <?php 
            $sql = "SELECT * FROM teams_members";
            $query = $conn->prepare($sql);
            $query->execute();
            $cnt = 0;

            while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
                if($cnt % 3 == 0) {
                    // Start a new row if $cnt is a multiple of 3 and close the previous row
                    if ($cnt > 0) {
                        echo '</div>'; // Close previous row
                    }
                    echo '<div class="row">'; // Start new row
                }
            ?>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="rounded-circle img-fluid" src="assets/images/team<?= htmlspecialchars($row['image']) ?>" alt="..." />
                        <h4><?php echo htmlspecialchars($row['name']) ?></h4>
                        <h4><?php echo htmlspecialchars($row['contact']) ?></h4>
                        <h4><?php echo htmlspecialchars($row['role']) ?></h4>
                        <a class="btn btn-info btn-social mx-2" href="#!" aria-label="Twitter Profile">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn btn-info btn-social mx-2" href="#!" aria-label="Facebook Profile">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-info btn-social mx-2" href="#!" aria-label="LinkedIn Profile">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                    </div>
                </div>
            <?php 
                $cnt++;
            } 
            // Ensure to close the last row
            if ($cnt > 0) {
                echo '</div>'; // Close the final row
            }
        ?>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
    </div>
</section>

        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">E-Commerce</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Responsive Design</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Web Security</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-sidebar p-4">
                    <div class="mb-3 col-lg-12">
                        <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Testimonial</h4>
                        <div class="recent-review  owl-dots-hover-success">
                            <?php
                            $sql = "SELECT testimonials.*, users.user_name, role.role_name 
                                    FROM testimonials
                                    JOIN users ON testimonials.user_id = users.id
                                    JOIN role ON users.role_id = role.id";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            $cnt = 0;
                            
                            while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
                                if($cnt % 3 == 0) {
                                    // Start a new row if $cnt is a multiple of 3 and close the previous row
                                    if ($cnt > 0) {
                                        echo '</div>'; // Close previous row
                                    }
                                    echo '<div class="row">'; // Start new row
                                }?>
                                <div class="item bg-info text-white p-3 rounded">
                                    <div class="star-rating mb-2">
                                        <?php for($i = 0; $i < $row['rating']; $i++) { ?>
                                            <i class="fas fa-star text-warning"></i>
                                        <?php } ?>
                                        <?php for($i = $row['rating']; $i < 5; $i++) { ?>
                                            <i class="fas fa-star text-secondary"></i>
                                        <?php } ?>
                                    </div>
                                    <p><?php echo $row['comment']; ?></p>
                                    <div class="mt-2">
                                        <span class="text-success d-block text-capitalize"><?php echo $row['user_name']; ?></span>
                                        <span class="text-capitalize"><?php echo $row['role_name']; ?></span>
                                    </div>
                                </div>
                            <?php    $cnt++;
            } 
            // Ensure to close the last row
            if ($cnt > 0) {
                echo '</div>'; // Close the final row
            } ?>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>


		<!--	Testonomial -->
<?php include('partials/footer.php')?>