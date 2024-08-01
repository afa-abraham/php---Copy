
<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$users = $db->query('select * from users')->get();

foreach ($users as $user) {
    if ($user['email'] === $_SESSION['user']['email']) {
        $user_id = $user['id'];
    }
}

// Check if the user is logged in
if (!isset($_SESSION['user']['email'])) {
    // Check if the current request is already going to /login to avoid a redirect loop
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) !== '/login') {
        header('Location: /login');
        exit();
    }
}

view('index.view.php', [
    'users' => $users
]);

?>
