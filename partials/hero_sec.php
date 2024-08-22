<div class="container">
    <div class="slider-banner1 position-relative" style="background-image: url('assets/images/rshmpg.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <div class="text-white">
                        <!-- <h1 class="mb-4"><span class="text-success">Find It</span><br>Find your property</h1> -->
                        <form method="post" enctype="multipart/form-data" action="propertygrid.php">
                            <div class="row">
                                <div class="col-md-6 col-lg-2">
                                    <div class="mb-3">
                                        <select class="form-select" name="p_type">
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
                                <div class="col-md-6 col-lg-2">
                                    <div class="mb-3">
                                        <select class="form-select" name="status">
                                            <option value="">Select Status</option>
                                            <option value="1">Available</option>
                                            <option value="0">Sold</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="location" placeholder="Enter Location" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-2">
                                    <div class="mb-3">
                                        <button type="submit" name="filter" class="btn btn-success w-100">Search Property</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
