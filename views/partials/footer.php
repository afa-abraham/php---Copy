<footer class="footer" >
    <div class="container-fluid" style="position: fixed; bottom:0;">
        <div class="row text-body-secondary">
            <div class="col-4 text-start ">
                <a class="text-body-secondary" href=" #">
                    <strong>© MatchMakeMe - 2024</strong>
                </a>
            </div>
            <div class="col-6 text-end text-body-secondary d-none d-md-block">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a class="text-body-secondary" href="#">Contact</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-body-secondary" href="#">About Us</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-body-secondary" href="#">Terms & Conditions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</div>
</div>

</body>

</html>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js
"></script>
<script>
  <?php if (isset($errors['status'])) : ?>
  Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "<?= $errors['status'] ?>",
  });
  <?php endif; ?>
</script>
<!-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Simple validation
            if (email === 'admin' && password === 'password') {
                // Display SweetAlert toast notification
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid username or password!',
                });
            }
        });
    </script> -->
<script>
    const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
</script>