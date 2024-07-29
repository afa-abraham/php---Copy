

<div class="main">

    <nav class="navbar navbar-expand px-4 py-3 flex-row" style="background: #0e2238;">
        <?php if ($_SESSION['user'] ?? false) : 'Guest' ?>

            <div class="d-flex">
                <a class="text-white">Hello, <?= $_SESSION['user']['email'] ?></a>
            </div>
            <div class="d-flex ms-auto justify-content-end">


                <a href="<?= ($roleId == 1) ? '/admin' : '/verified-user' ?>" class="text-white">&nbsp;<i class="fa-solid fa-house"></i>&nbsp;Dashboard</a>
                <a href="/verify-account" class="px-5">
                    <i></i>
                    <span class="text-white"><i class="fa-solid fa-user"></i>&nbsp;My Account</span>
                </a>

                <form method="POST" action="/session">
                    <input type="hidden" name="_method" value="DELETE" />

                    <button class="text-white" style="background: transparent;"><i class="fa-solid fa-power-off text-danger"></i>&nbsp;Log Out</button>
                </form>


            <?php else : ?>
                <a href="/register" class="<?= urlIs('/register') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-white font-medium">Register</a>
                <a href="/login" class="<?= urlIs('/login') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-white font-medium">Log
                    In</a>

            <?php endif ?>
            </div>


    </nav>