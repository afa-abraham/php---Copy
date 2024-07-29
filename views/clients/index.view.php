<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<a type="btn btn-primary" href="/clients/create" class="my-2 py-2 mx-auto" style="background: blue;color:white; width:150px;">&nbsp;Add Client Details</a>
<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>


  <?php require base_path('views/partials/footer.php') ?>