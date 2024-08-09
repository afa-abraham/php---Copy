<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>


<section class="chat">
                    <div class="header-chat">
                        <i class="icon fa-solid fa-user" aria-hidden="true"></i>
                        <p class="name"><?= htmlspecialchars($messages[0]['sender_name']) ?></p>

                    </div>
                    <!-- Sender's message -->
                    <div class="messages-chat">
                    <?php foreach ($messages as $message) : ?>
                        <?= $message['sender_name'] == $messages[0]['sender_name'] ? 
    '<div class="message">
        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
            <div class="online"></div>
        </div>
        <div class="message text-only">
            <p class="text">' . htmlspecialchars($message['message_body']) . '</p>
        </div>
        <p class="time">' . htmlspecialchars($message['sent_at']) . '</p>
    </div>' : 
    '<div class="message text-only">
        <div class="response">
            <p class="text">' . strip_tags(htmlspecialchars($message['message_body'])) . '</p>
        </div>
        <p class="response-time time">' . htmlspecialchars($message['sent_at']) . '</p>
    </div>'; ?>
    <?php endforeach; ?>
                    <form action="#" class="footer-chat">
                        <i class="icon fa-solid fa-smile clickable" style="font-size:25pt;" aria-hidden="true"></i>

                        <input type="text" class="write-message" id="message" name="message" placeholder="Type your message here"></input>
                        <a class="button"><i class="icon send fa-solid fa-paper-plane clickable"></i></a>
                    </form>

                </section>

<?php require base_path('views/partials/footer.php'); ?>