
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

view('index.view.php', [
    'users' => $users
]);

?>
