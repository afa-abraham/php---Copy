<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$users = $db->query('select * from users')->get(); ?>

<?php foreach ($users as $user) {
    if ($user['email'] === $_SESSION['user']['email']) {
        $roleId = $user['role_id'];
        break;
    }
}
?>

<div class="wrapper">
    <?php if ($_SESSION['user'] ?? false) : ?>
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">MatchMakeMe</a>
                </div>
            </div>
            <?= $roleId === 1 ? '
<ul class="sidebar-nav">
    <li class="sidebar-item">
        <a href="#" class="sidebar-link">
            <i class="lni lni-user"></i>
            <span>View Women</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/womens" class="sidebar-link">
            <i class="lni lni-user"></i>
            <span>Women Accounts List</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/womens/create" class="sidebar-link">
            <i class="lni lni-agenda"></i>
            <span>Add Woman Account</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/clients" class="sidebar-link">
            <i class="lni lni-agenda"></i>
            <span>Add Client Details</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/womens/nonverified" class="sidebar-link">
            <i class="lni lni-user"></i>
            <span>Non-verified Accounts List</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
            <i class="lni lni-protection"></i>
            <span>My Inbox</span>
        </a>
        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">Unread Messages</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">Read Messages</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">Unanswered Messages</a>
            </li>
            
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">Answered Messages</a>
            </li>
        </ul>
    </li>
   
</ul>
' : '
<ul class="sidebar-nav">
    <li class="sidebar-item">
        <a href="/mails/create" class="sidebar-link">
            <i class="fa-solid fa-pen-nib"></i>
            <span>Compose</span>
        </a>
    </li>
    <br>
    
    <li class="sidebar-item">
        <a href="/mails/inbox" class="sidebar-link">
            <i class="fa-solid fa-inbox"></i>
            <span>Inbox</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/mails" class="sidebar-link">
            <i class="fa fa-envelope"></i>
            <span>Unread messages</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/mails/drafts" class="sidebar-link">
            <i class="fab fa-firstdraft"></i>
            <span>Draft</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/mails/sent" class="sidebar-link">
            <i class="fa-solid fa-paper-plane"></i>
            <span>Sent</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="/mails" class="sidebar-link">
            <i class="fa fa-archive"></i>
            <span>Archived Mails</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/mails" class="sidebar-link">
            <i class="fa fa-trash"></i>
            <span>Deleted Mails</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="/mail" class="sidebar-link">
            <i class="fa-solid fa-eye-slash"></i>
            <span>Refused</span>
        </a>
    </li>

</ul>
';
            ?>

        </aside>

    <?php endif ?>