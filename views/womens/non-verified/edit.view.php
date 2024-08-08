<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<a href="/womens/nonverified"><button class="btn btn-lg btn-secondary mt-3" ><< &nbsp; Cancel </button></a>
<div class="new-account-form">
    <form action="/womens/nonverified/store" method="POST" class="my-4 p-4 shadow rounded bg-white inline-form" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $women['id'] ?>">
        <fieldset class="mx-lg-5 my-lg-3 inline-form">
            <div class="row">
                <div class=" col-lg-4 col-sm-6 form-floating mb-3">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?= $women['lname'] ?>" autocomplete="off" required>
                    <label for="lname" >&nbsp; Last Name</label>
                </div>
                <div class=" col-lg-4 col-sm-6 form-floating mb-3">
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?= $women['middle_name'] ?>" autocomplete="off" required>
                    <label for="middle_name" >&nbsp; Middle Name</label>
                </div>
                <div class=" col-lg-4 col-sm-6 form-floating mb-3">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?= $women['fname'] ?>" autocomplete="off" required>
                    <label for="fname" >&nbsp; First Name</label>
                </div>
            </div>
            <div class="row">
                <div class=" col-lg-4 col-sm-6 col-6 form-floating mb-3">
                    <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?= $women['age'] ?>" autocomplete="off" required>
                    <label for="age">&nbsp; Age</label>
                </div>
                <div class=" col-lg-4 col-sm-6 col-6 form-floating mb-3">
                    <input type="date" class="form-control py-3" id="birthdate" name="birthdate"  placeholder="" autocomplete="off" required>
                    <label for="age" >&nbsp; Birthdate</label>
                </div>
                <div class=" col-lg-4 col-sm-6 form-floating mb-3">
                    <!-- <input type="text" class="form-control" id="floatingMaritalStatus" name="marital_status" placeholder="Marital Status" autocomplete="off">
                                    <label for="floatingMaritalStatus">Marital Status</label> -->
                    <select class="form-select" name="marital_status" id="marital_status" value="">
                        <option selected disabled>&nbsp; <?= isset($women['marital_status']) ? $women['marital_status'] : "Marital Status" ?></option>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widowed</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class=" col-12 col-lg-6 col-sm-12 form-floating mb-3">
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number"  placeholder="0000 000 0000" autocomplete="off" required value="<?= $women['mobile_number'] ?>">
                    <label for="mobile_number">&nbsp; Mobile</label>
                </div>
                <div class=" col-12 col-lg-6 col-sm-12 form-floating mb-3">
                    <input type="text" class="form-control" id="fb_link" name="fb_link" placeholder="Facebook Profile Link" value="<?= $women['fb_link'] ?>" autocomplete="off" required>
                    <label for="fb_link">&nbsp; Facebook Profile Link</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 form-floating my-3">
                    <div class="upload-container">
                        <h6>Upload your images :</h6>

                        <div class="drag-area">
                            <div class="icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <span class="header">Drag & Drop</span>
                            <span class="header">or <span class="button">browse</span></span>
                            <input type="file" hidden name="img" multiple accept=".jpg, .jpeg, .png, .gif" />
                            <span class="support">Supports: JPEG, JPG, PNG</span>
                        </div>
                        <div>
                            <div class="alert alert-warning" role="alert">
                                <strong>Please Read:</strong>
                                <ol class="list-group">
                                    <li class="list-group-item bg-transparent border-0 p-1 mb-2"><small>
                                            <strong>1. </strong> Please attach at least 3 best photos of yourself, at least 1 full body photo and at least 1 portrait photo. You can attach a maximum of 6 photos of yourself below.
                                        </small></li>
                                    <li class="list-group-item bg-transparent border-0 p-1 mb-2"><small>
                                            <strong>2. </strong> Please do not send pictures of family or friends.<br />
                                            I want it to be a single picture of you only.
                                        </small></li>
                                    <li class="list-group-item bg-transparent border-0 p-1 mb-2"><small><strong>3. </strong> All information will be used for your IAC application only.</small></li>
                                    <li class="list-group-item bg-transparent border-0 p-1 mb-2"><small><strong>4. </strong> Please upload photos as JPG or PNG files only and less than 5 megabytes in size.</small></li>
                                </ol>
                            </div>
                            <button class="download" >Upload</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 form-floating my-3">
                    <div class="upload-container">
                        <h6>Upload your intro video :</h6>
                        <div class="drag-area">
                            <div class="icon">
                                <i class="fas fa-images"></i>
                            </div>
                            <span class="header">Drag & Drop</span>
                            <span class="header">or <span class="button">browse</span></span>
                            <input type="file" hidden accept="video/mp4, video/avi, videp/webm" name="intro_video" />
                            <span class="support">Supports: MP4, AVI, WEBM</span>
                        </div>
                        <div>
                            <button class="download"  >Upload</button>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="d-flex justify-content-center">
                   
                        <button class="verify btn btn-lg btn-primary mt-3" type="submit" name="">Proceed &nbsp; >></button>
                    </div>
                    
                
        </fieldset>
    </form>
</div>







<?php require base_path('views/partials/footer.php') ?>