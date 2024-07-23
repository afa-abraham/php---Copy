
<?php require base_path('views/partials/head.php') ?>


<div class="d-flex align-items-center py-4 bg-body-tertiary " style="height:100vh; background-image: url('https://media.licdn.com/dms/image/C5612AQFpDFrJBY_Yxg/article-cover_image-shrink_600_2000/0/1520175471206?e=2147483647&v=beta&t=uSBfi73i1_M83R2M2rI6G4QsYFtSoKR9Alfk-HNqiYw');background-size: cover;background-position:center;">
    <main class="form-signin w-100 m-auto" style="padding: 1rem; max-width: 350px;">
        <form action="/session" method="POST">
            <img class="mb-4" src="https://a-foreign-affair.com/img/a-foreign-affair-logo.png" alt="" width="280" height="100">
            <h1 class="h3 mb-3 fw-normal text-white">Log in</h1>


            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" autocomplete="email" placeholder="name@example.com" required>
                <label for="email"><i class="fa-solid fa-envelope"></i> Email address </label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password">
                <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary btn-lg mb-3 w-100 py-2" type="submit">Sign in</button>
            <p class="text-center">or</p>
            <a href="<? $client->createAuthUrl() ?>" class="w-100 btn btn-lg btn-outline-default bg-white mb-3 py-3 shadow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-google text-primary" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                </svg> Sign in with Google</a>

            <p>Don't have an account?<a href="/register">Sign Up</a></p>
            <p class="mt-5 mb-3 text-white">©MatchMakeMe 2024</p>
        </form>
    </main>
</div
