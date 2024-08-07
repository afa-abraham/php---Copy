<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main>
    <h3><?= $women['full_name']  ?></h3>
        <ul>
            <li>First Name:<?= $women['first_name'] ?></li>
            <li>Last Name:<?= $women['last_name'] ?></li>
            <li>Middle Name:<?= $women['middle_name'] ?></li>
            <li>Age:<?= $women['age'] ?></li>
            <li>Birthdate:<?= $women['birthdate'] ?></li>
            <li>Mobile Number:<?= $women['mobile_number'] ?></li>
            <li>Marital Status:<?= $women['marital_status'] ?></li>
            <li>Facebook Link<?= $women['fb_link'] ?></li>
        </ul>
         
        <div class="d-flex">
        <a type="button" class="btn btn-primary" href="/womens/nonverified/update?id=<?= $women['id'] ?>">Edit</a>
        
        <form class="mt-6" method="POST" action="/womens/update">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $women['id'] ?>">
            <button class="btn btn-success">Verify</button>
        </form>
        </div>

</main>

<script>
    function verify() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('verifyForm').submit();
            }
        });
    }
</script>



 




<?php require base_path('views/partials/footer.php') ?>