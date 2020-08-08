<?php include('header.php') ?>


<!-- Main Slider With Form -->
<section class="samar-slider">
    <div id="samarslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#samarslider" data-slide-to="0" class="active"></li>
            <li data-target="#samarslider" data-slide-to="1"></li>
            <li data-target="#samarslider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active slider-one">
                <div class="overlay"></div>
            </div>
            <div class="carousel-item slider-two">
                <div class="overlay"></div>
            </div>
            <div class="carousel-item slider-three">
                <div class="overlay"></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#samarslider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#samarslider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="slider-form">
        <div class="container">
            <h2 class="text-left mb-1 text-white d-none d-sm-block">Rent an office</h2>
            <p class="text-white mb-5 d-none d-sm-block">We have the office which suites your needs. You are just one step away from finding the right office.</p>
            <form>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">For Sale</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">For Rent</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></div>
                                    <input class="form-control" placeholder="Enter Location or Landmark" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="mdi mdi-google-maps"></i></div>
                                    <select class="form-control select2 no-radius">
                                        <option value="">Locations</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="mdi mdi-security-home"></i></div>
                                    <select class="form-control select2 no-radius">
                                        <option value="">Property Type</option>
                                        <option value="">House/Villa</option>
                                        <option value="">Flat</option>
                                        <option value="">Plot/Land</option>
                                        <option value="">Office Space</option>
                                        <option value="">Shop/Showroom</option>
                                        <option value="">Commercial Land</option>
                                        <option value="">Warehouse/ Godown</option>
                                        <option value="">Industrial Building</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-secondary btn-block no-radius font-weight-bold">SEARCH</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row no-gutters">
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="mdi mdi-map-marker-multiple"></i></div>
                                    <input class="form-control" placeholder="Enter Location or Landmark" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="mdi mdi-security-home"></i></div>
                                    <select class="form-control select2 no-radius">
                                        <option value="">Property Type</option>
                                        <option value="">House/Villa</option>
                                        <option value="">Flat</option>
                                        <option value="">Plot/Land</option>
                                        <option value="">Office Space</option>
                                        <option value="">Shop/Showroom</option>
                                        <option value="">Commercial Land</option>
                                        <option value="">Warehouse/ Godown</option>
                                        <option value="">Industrial Building</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-secondary btn-block no-radius font-weight-bold">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- End Main Slider With Form -->
<!-- Properties List -->
<section class="section-padding">
    <div class="section-title text-center mb-5">
        <h2>Latest Properties</h2>
        <div class="line mb-2"></div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card card-list">
                    <a href="#">
                        <div class="card-img">
                            <div class="badge images-badge"><i class="mdi mdi-image-filter"></i> 12</div>
                            <span class="badge badge-primary">For Sale</span>
                            <img class="card-img-top" src="img/list/1.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="text-primary mb-2 mt-0">
                                $130,000 <small>/month</small>
                            </h2>
                            <h5 class="card-title mb-2">House in Kent Street</h5>
                            <h6 class="card-subtitle mt-1 mb-0 text-muted"><i class="mdi mdi-home-map-marker"></i> 127 Kent Sreet, Sydny, NEW 2000</h6>
                        </div>
                        <div class="card-footer">
                            <span><i class="mdi mdi-sofa"></i> Beds : <strong>3</strong></span>
                            <span><i class="mdi mdi-scale-bathroom"></i> Baths : <strong>2</strong></span>
                            <span><i class="mdi mdi-move-resize-variant"></i> Area : <strong>587 sq ft</strong></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card card-list">
                    <a href="#">
                        <div class="card-img">
                            <div class="badge images-badge"><i class="mdi mdi-image-filter"></i> 60</div>
                            <span class="badge badge-secondary">For Rent</span>
                            <img class="card-img-top" src="img/list/2.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="text-primary mb-2 mt-0">
                                $127,000 <small>/month</small>
                            </h2>
                            <h5 class="card-title mb-2">Family House in Hudson</h5>
                            <h6 class="card-subtitle mt-1 mb-0 text-muted"><i class="mdi mdi-home-map-marker"></i> Hoboken, NJ, USA</h6>
                        </div>
                        <div class="card-footer">
                            <span><i class="mdi mdi-sofa"></i> Beds : <strong>5</strong></span>
                            <span><i class="mdi mdi-scale-bathroom"></i> Baths : <strong>3</strong></span>
                            <span><i class="mdi mdi-move-resize-variant"></i> Area : <strong>300 sq ft</strong></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card card-list">
                    <a href="#">
                        <div class="card-img">
                            <div class="badge images-badge"><i class="mdi mdi-image-filter"></i> 03</div>
                            <span class="badge badge-success">For Sale</span>
                            <img class="card-img-top" src="img/list/3.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="text-primary mb-2 mt-0">
                                $55,000 <small>/month</small>
                            </h2>
                            <h5 class="card-title mb-2">Loft Above The City</h5>
                            <h6 class="card-subtitle mt-1 mb-0 text-muted"><i class="mdi mdi-home-map-marker"></i> Hope Street (Stop P), London SW11, UK</h6>
                        </div>
                        <div class="card-footer">
                            <span><i class="mdi mdi-sofa"></i> Beds : <strong>2</strong></span>
                            <span><i class="mdi mdi-scale-bathroom"></i> Baths : <strong>1</strong></span>
                            <span><i class="mdi mdi-move-resize-variant"></i> Area : <strong>100 sq ft</strong></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card card-list">
                    <a href="#">
                        <div class="card-img">
                            <div class="badge images-badge"><i class="mdi mdi-image-filter"></i> 18</div>
                            <span class="badge badge-danger">For Sale</span>
                            <img class="card-img-top" src="img/list/4.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="text-primary mb-2 mt-0">
                                $25,000 <small>/month</small>
                            </h2>
                            <h5 class="card-title mb-2">Store Space Greenville</h5>
                            <h6 class="card-subtitle mt-1 mb-0 text-muted"><i class="mdi mdi-home-map-marker"></i> 250-260 3rd St, Hoboken, NJ 07030, USA</h6>
                        </div>
                        <div class="card-footer">
                            <span><i class="mdi mdi-sofa"></i> Beds : <strong>6</strong></span>
                            <span><i class="mdi mdi-scale-bathroom"></i> Baths : <strong>4</strong></span>
                            <span><i class="mdi mdi-move-resize-variant"></i> Area : <strong>987 sq ft</strong></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card card-list">
                    <a href="#">
                        <div class="card-img">
                            <div class="badge images-badge"><i class="mdi mdi-image-filter"></i> 04</div>
                            <span class="badge badge-warning">For Rent</span>
                            <img class="card-img-top" src="img/list/5.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="text-primary mb-2 mt-0">
                                $12,000 <small>/month</small>
                            </h2>
                            <h5 class="card-title mb-2">Villa in Melbourne</h5>
                            <h6 class="card-subtitle mt-1 mb-0 text-muted"><i class="mdi mdi-home-map-marker"></i> NJ 07305, USA</h6>
                        </div>
                        <div class="card-footer">
                            <span><i class="mdi mdi-sofa"></i> Beds : <strong>8</strong></span>
                            <span><i class="mdi mdi-scale-bathroom"></i> Baths : <strong>4</strong></span>
                            <span><i class="mdi mdi-move-resize-variant"></i> Area : <strong>120 sq ft</strong></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card card-list">
                    <a href="#">
                        <div class="card-img">
                            <div class="badge images-badge"><i class="mdi mdi-image-filter"></i> 45</div>
                            <span class="badge badge-info">For Rent</span>
                            <img class="card-img-top" src="img/list/6.png" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="text-primary mb-2 mt-0">
                                $356, 000 <small>/month</small>
                            </h2>
                            <h5 class="card-title mb-2">Villa on Hollywood Boulev</h5>
                            <h6 class="card-subtitle mt-1 mb-0 text-muted"><i class="mdi mdi-home-map-marker"></i> The Village, Jersey City, NJ 07302, USA</h6>
                        </div>
                        <div class="card-footer">
                            <span><i class="mdi mdi-sofa"></i> Beds : <strong>1</strong></span>
                            <span><i class="mdi mdi-scale-bathroom"></i> Baths : <strong>3</strong></span>
                            <span><i class="mdi mdi-move-resize-variant"></i> Area : <strong>187 sq ft</strong></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="offices.php">
                    <button class="btn btn-secondary font-weight-bold btn-lg">VIEW ALL</button>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End Properties List -->
<!-- Properties by City -->
<section class="section-padding bg-grey">
    <div class="section-title text-center mb-5">
        <h2>Property By City</h2>
        <div class="line mb-2"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card bg-dark text-white card-overlay">
                    <a href="#">
                        <img class="card-img" src="img/overlay/1.png" alt="Card image">
                        <div class="card-img-overlay">
                            <h3 class="card-title text-white">California</h3>
                            <p class="card-text text-white">16 Properties</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card bg-dark text-white card-overlay">
                    <a href="#">
                        <img class="card-img" src="img/overlay/2.png" alt="Card image">
                        <div class="card-img-overlay">
                            <h3 class="card-title text-white">New York</h3>
                            <p class="card-text text-white">16 Properties</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card bg-dark text-white card-overlay">
                    <a href="#">
                        <img class="card-img" src="img/overlay/3.png" alt="Card image">
                        <div class="card-img-overlay">
                            <h3 class="card-title text-white">Los Angeles</h3>
                            <p class="card-text text-white">265 Properties</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-dark text-white card-overlay">
                    <a href="#">
                        <img class="card-img" src="img/overlay/4.png" alt="Card image">
                        <div class="card-img-overlay">
                            <h3 class="card-title text-white">Chicago</h3>
                            <p class="card-text text-white">620 Properties</p>
                        </div>
                    </a>
                    .
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card bg-dark text-white card-overlay">
                    <a href="#">
                        <img class="card-img" src="img/overlay/5.png" alt="Card image">
                        <div class="card-img-overlay">
                            <h3 class="card-title text-white">Philadelphia</h3>
                            <p class="card-text text-white">28 Properties</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Properties by City -->





<?php include('footer.php') ?>