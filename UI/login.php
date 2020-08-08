<?php include('header.php') ?>

<section class="section-padding bg-dark inner-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-0 mb-3">Login</h1>
                <div class="breadcrumbs">
                    <p class="mb-0"><a href="#"><i class="mdi mdi-home-outline"></i> Home</a> / Login</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Login -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 mx-auto">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card padding-card no-radius border t-align-l h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Login</h5>
                                <form>
                                    <div class="form-group">
                                        <label>Email address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Enter Email address">
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                            <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">SIGN IN</button>
                                </form>
                                <div class="mt-2 text-center">
                                    <a href="forget.html">Forget your password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card padding-card no-radius border t-align-l h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Login with</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</p>
                                <div class="mt-4 text-center login-with-social">
                                    <button type="button" class="btn btn-facebook btn-block"><i class="mdi mdi-facebook"></i> Login With Facebook</button>
                                    <button type="button" class="btn btn-twitter btn-block"><i class="mdi mdi-twitter"></i> Login With Twitter</button>
                                    <button type="button" class="btn btn-google btn-block"><i class="mdi mdi-google-plus"></i> Login With Google</button>
                                    <button type="button" class="btn btn-pinterest btn-block"><i class="mdi mdi-pinterest"></i> Login With Pinterest</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login -->

<?php include('footer.php') ?>