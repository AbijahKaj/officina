<?php include('header.php') ?>


<section class="section-padding bg-dark inner-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-0 mb-3">Register</h1>
                <div class="breadcrumbs">
                    <p class="mb-0"><a href="#"><i class="mdi mdi-home-outline"></i> Home</a> / Register</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Register -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 mx-auto">
                <div class="card padding-card no-radius border t-align-l">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Register</h5>
                        <form>
                            <div class="form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Full Name">
                            </div>
                            <div class="form-group">
                                <label>Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Mobile Number">
                            </div>
                            <div class="form-group">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">I agree with all <a href="terms.html">Terms & Conditions</a></label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTER</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Register -->

<?php include('footer.php') ?>