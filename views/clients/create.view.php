<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>



<form action="/clients/store" method="POST">
  <div class="row g-3">
    <div class="col-sm-3">
      <label for="fname" class="form-label">First name</label>
      <input type="text" class="form-control" name="fname" id="fname" placeholder="" value="" >



    </div>

    <div class="col-sm-3">
      <label for="lname" class="form-label">Last name</label>
      <input type="text" class="form-control" name="lname" id="lname" placeholder="" value="" >


    </div>
    <div class="col-sm-2">
      <label for="age" class="form-label">Age</label>
      <input type="text" class="form-control" id="age" name="age" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="location" class="form-label">Location</label>
      <input type="text" class="form-control" id="location" name="location" placeholder="" value="" >


    </div>
    <div class="col-sm-2">
      <label for="height" class="form-label">Height</label>
      <input type="text" class="form-control" id="height" name="height" placeholder="" value="" >
    </div>
    <div class="col-sm-2">
      <label for="weight" class="form-label">Weight</label>
      <input type="text" class="form-control" id="weight" name="weight" placeholder="" value="" >


    </div>
    <div class="col-sm-8">
      <label for="interested" class="form-label">I am interested in ladies between</label>
      <input type="text" class="form-control" id="interested" name="interested" placeholder="" value="" >


    </div>
    <h2>Profile Basics</h2>
    <div class="col-sm-3">
      <label for="body_type" class="form-label">Body Type</label>
      <input type="text" class="form-control" id="body_type" name="body_type" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="hair_color" class="form-label">Hair Color</label>
      <input type="text" class="form-control" id="hair_color" name="hair_color" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="eyes_color" class="form-label">Eyes Color</label>
      <input type="text" class="form-control" id="eyes_color" name="eyes_color" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="ethnicity" class="form-label">Ethnicity</label>
      <input type="text" class="form-control" id="ethnicity" name="ethnicity" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="marital_status" class="form-label">Marital Status</label>
      <input type="text" class="form-control" id="marital_status" name="marital_status" placeholder="" value="" >


    </div>
    <div class="col-sm-2">
      <label for="smoking" class="form-label">Smoking</label>
      <input type="text" class="form-control" id="smoking" name="smoking" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="drinking" class="form-label">Drinking</label>
      <input type="text" class="form-control" id="drinking" name="drinking" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="religion" class="form-label">Religion</label>
      <input type="text" class="form-control" id="religion" name="religion" placeholder="" value="" >


    </div>
    <div class="col-sm-10">
      <label for="education" class="form-label">Education</label>
      <input type="text" class="form-control" id="education" name="education" placeholder="" value="" >


    </div>
  
    <div class="col-sm-3">
      <label for="children" class="form-label">Children</label>
      <input type="text" class="form-control" id="children" name="children" placeholder="" value="" >


    </div>
    <div class="col-sm-3">
      <label for="no_of_children" class="form-label">Number of children</label>
      <input type="text" class="form-control" id="no_of_children" name="no_of_children" placeholder="" value="" >


    </div>

    <h2>About Me</h2>
    <div class="col-sm-5">
      <label for="employment" class="form-label">Employment</label>
      <input type="text" class="form-control" id="employment" name="employment" placeholder="" value="" >


    </div>
    <div class="col-sm-12">
      <textarea name="description" id="description" rows="10" cols="80" placeholder="Describe Yourself (Hobby's and Interests)"></textarea>


    </div>
    <div class="col-sm-12">
      <textarea name="idealMatch" id="idealMatch" rows="10" cols="80" placeholder="Your Ideal Match (About Her):"></textarea>
    </div>
    <div class="col-sm-12">
      <textarea name="additional_comments" id="additional_comments" rows="10" cols="80" placeholder="Additional comments"></textarea>
    </div>



    <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
  </div>
</form>


<?php require base_path('views/partials/footer.php') ?>