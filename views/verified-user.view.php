<?php require base_path('db/config.php');

// SQL query
$sql = "SELECT * FROM users";

// Execute query
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if ($result) {
    // Fetch all rows into an associative array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Loop through the fetched users array
    foreach ($users as $user) {
        // Check if the user's email matches the email in the session
        if ($user['email'] === $_SESSION['user']['email']) {
            $_SESSION['user_id'] = $user['id'];
            break; // Exit the loop once the user is found
        }
    }

    // Free result set
    mysqli_free_result($result);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

$user_id = $_SESSION['user_id'];

//Inbox Query
$sql = "SELECT (mails.id) as id, mails.thread_id, mails.body,mails.created_at, sender.full_name AS sender_name, sender.profile_image AS sender_image 
        FROM mails 
        JOIN users AS sender ON mails.sender_id = sender.id 
        JOIN user_mail_status ON mails.id = user_mail_status.mail_id 
        WHERE mails.receiver_id = ? AND user_mail_status.user_id = ? 
        AND user_mail_status.is_deleted = 0 AND user_mail_status.is_archived = 0 
        AND mails.created_at = (
                SELECT MAX(m.created_at)
                FROM mails m
                WHERE m.thread_id = mails.thread_id
            )
        ORDER BY 
            mails.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();




// if (!isset( $sender_id)) {

//      // Get sender_id and user_id from POST request
//      $sender_id = intval($_POST['sender_id']);
//      $user_id = intval($_POST['user_id']);
 

// // Query to get all messages from the specific sender
// $sql = "SELECT (mails.id) as id , mails.body, mail.created_at, sender.full_name AS sender_name, sender,profile_image AS sender_image FROM mails
//     JOIN users AS sender ON mails.sender_id = sender.id
//     JOIN user_mail_status ON mails.id = user_mail_status.mail_id
//     WHERE mails.sender_id = ? 
//     AND mails.receiver_id = ? 
//     AND user_mail_status.user_id = ? 
//     AND user_mail_status.is_deleted = 0 
//     AND user_mail_status.is_archived = 0
//     ORDER BY mails.created_at ASC";

//     // Prepare and execute the statement
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("iii", $sender_id, $user_id, $user_id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Fetch all messages
//     $messages = $result->fetch_all(MYSQLI_ASSOC);

//     // Check if there are messages and display them
//     if (count($messages) > 0) {
//         foreach ($messages as $message) {
//             echo "<div class='message'>";
//             echo "<p><strong>From:</strong> " . htmlspecialchars($message['sender_name']) . "</p>";
//             echo "<p><strong>Sent:</strong> " . htmlspecialchars($message['created_at']) . "</p>";
//             echo "<p><strong>Message:</strong> " . htmlspecialchars($message['body']) . "</p>";
//             echo "</div>";
//         }
//     } else {
//         echo "<p>No messages found from this sender.</p>";
//     }
// } else {
//     echo "<p>Invalid request.</p>";
// }

// // Close the database connection
// $conn->close();



// $sql = "
//     SELECT mails.id, mails.thread_id, mails.body, mails.created_at, sender.full_name AS sender_name, sender.profile_image AS sender_image
//     FROM mails
//     JOIN users AS sender ON mails.sender_id = sender.id
//     JOIN user_mail_status ON mails.id = user_mail_status.mail_id
//     WHERE mails.thread_id IN (
//         SELECT MAX(mails.id) as id
//         FROM mails
//         JOIN users AS sender ON mails.sender_id = sender.id
//         JOIN user_mail_status ON mails.id = user_mail_status.mail_id
//         WHERE sender.id = ? 
//         AND mails.receiver_id = ? 
//         AND user_mail_status.user_id = ? 
//         AND user_mail_status.is_deleted = 0 
//         AND user_mail_status.is_archived = 0
//         GROUP BY mails.thread_id
//     )
//     AND mails.receiver_id = ? 
//     AND user_mail_status.user_id = ? 
//     AND user_mail_status.is_deleted = 0 
//     AND user_mail_status.is_archived = 0
//     ORDER BY mails.created_at DESC
// ";

// // Prepare and execute the statement
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("iiiii", $sender_id, $user_id, $user_id, $user_id, $user_id);
// $stmt->execute();
// $result = $stmt->get_result();

// // Fetch all messages
// $messages = $result->fetch_all(MYSQLI_ASSOC);


?>




<?php require('partials/head.php') ?>
<?php if ($_SESSION['user'] ?? false) : ?>
    <?php require('partials/sidebar.php') ?>
    <?php require('partials/nav.php') ?>


    <?php if ($roleId != 2): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: <?= json_encode($roleId == 3 ? "Please verify your account first" : "You have no access to this page"); ?>
        }).then(function() {
            window.history.back(); // Go back to the previous page
        });
    </script>
    <?php exit; ?>
<?php endif; ?>

    <style>
        .discussions {
            width: 25%;
            height: 700px;
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
            overflow: hidden;
            background-color: #87a3ec;
            display: inline-block;
        }

        .discussions .discussion {
            width: 100%;
            height: 90px;
            background-color: #FAFAFA;
            border-bottom: solid 1px #E0E0E0;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .discussions .search {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #E0E0E0;
        }

        .discussions .search .searchbar {
            height: 40px;
            background-color: #FFF;
            width: 70%;
            padding: 0 20px;
            border-radius: 50px;
            border: 1px solid #EEEEEE;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .discussions .search .searchbar input {
            margin-left: 15px;
            height: 38px;
            width: 100%;
            border: none;
            font-family: 'Montserrat', sans-serif;
            ;
        }

        .discussions .search .searchbar *::-webkit-input-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *:-moz-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *::-moz-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *:-ms-input-placeholder {
            color: #E0E0E0;
        }

        .discussions .message-active {
            width: 100%;
            height: 90px;
            background-color: #FFF;
            border-bottom: solid 1px #E0E0E0;
        }

        .discussions .discussion .photo {
            margin-left: 20px;
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .online {
            position: relative;
            top: 30px;
            left: 35px;
            width: 13px;
            height: 13px;
            background-color: #8BC34A;
            border-radius: 13px;
            border: 3px solid #FAFAFA;
        }

        .desc-contact {
            height: 43px;
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .discussions .discussion .name {
            margin: 0 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11pt;
            color: #515151;
        }

        .discussions .discussion .message {
            margin: 6px 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 9pt;
            color: #515151;
        }

        .timer {
            margin-left: 15%;
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            padding: 3px 8px;
            color: #BBB;
            background-color: #FFF;
            border: 1px solid #E5E5E5;
            border-radius: 15px;
        }


        .chat {
            width: calc(40% - 85px);
        }

        .client_profile {
            width: calc(40% - 85px);
        }

        .header-chat {
            background-color: #FFF;
            height: 90px;
            box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.100);
            display: flex;
            align-items: center;
        }

        .chat .header-chat .icon {
            margin-left: 30px;
            color: #515151;
            font-size: 14pt;
        }

        .chat .header-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .header-chat .right {
            position: absolute;
            right: 40px;
        }

        .chat .messages-chat {
            padding: 25px 35px;
        }

        .chat .messages-chat .message {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .chat .messages-chat .message .photo {
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .chat .messages-chat .text {
            margin: 0 35px;
            background-color: #f6f6f6;
            padding: 15px;
            border-radius: 12px;
        }

        .text-only {
            margin-left: 45px;
        }

        .time {
            font-size: 10px;
            color: lightgrey;
            margin-bottom: 10px;
            margin-left: 85px;
        }

        .response-time {
            float: right;
            margin-right: 40px !important;
        }

        .response {
            float: right;
            margin-right: 0px !important;
            margin-left: auto;
            /* flexbox alignment rule */
        }

        .response .text {
            background-color: #e3effd !important;
        }

        .footer-chat {
            width: calc(40% - 120px);
            height: 80px;
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 0;
            background-color: transparent;
            border-top: 2px solid #EEE;

        }

        .chat .footer-chat .icon {
            margin-left: 30px;
            color: #C0C0C0;
            font-size: 14pt;
        }

        .chat .footer-chat .send {
            color: #fff;
            background-color: #4f6ebd;
            position: absolute;
            right: 50px;
            padding: 12px 12px 12px 12px;
            border-radius: 50px;
            font-size: 14pt;
            top: 20px;
        }

        .chat .footer-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .footer-chat .right {
            position: absolute;
            right: 40px;
        }

        .write-message {
            border: none !important;
            width: 60%;
            height: 50px;
            margin-left: 20px;
            padding: 10px;
        }

        .footer-chat *::-webkit-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .footer-chat input *:-moz-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .footer-chat input *::-moz-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
            margin-left: 5px;
        }

        .footer-chat input *:-ms-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .clickable {
            cursor: pointer;
        }
    </style>
    <main>

        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h1>User Dashboard</h1>
            <div class="row">
                <section class="discussions">
                    <div class="discussion search">
                        <div class="searchbar">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" placeholder="Search...">
                        </div>
                    </div>
                    <?php

                    while ($row = $result->fetch_assoc()) {

                    ?>

                        <div class="discussion">
                            <div class="photo" style="background-image: url(/uploads/<?php echo htmlspecialchars($row['sender_image']); ?>);">

                            </div>
                            <div class="desc-contact">
                                <p class="name"><?php echo htmlspecialchars($row['sender_name']); ?></p>
                                <p class="message"><?php echo htmlspecialchars($row['body']); ?></p>
                            </div>
                            <div class="timer"><?php echo htmlspecialchars($row['created_at']); ?></div>
                        </div>
                    <?php } ?>
                </section>
                <section class="chat">
                    <div class="header-chat">
                        <i class="icon fa-solid fa-user" aria-hidden="true"></i>
                        <p class="name"><?php echo $user['first_name'] . " " . $user['last_name'] ?></p>

                    </div>
                    <div class="messages-chat">
                        <div class="message">
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text"> Hi, how are you ? </p>
                        </div>
                        <div class="message text-only">
                            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
                        </div>
                        <p class="time"> 14h58</p>
                        <div class="message text-only">
                            <div class="response">
                                <p class="text"> Hey Megan ! It's been a while 😃</p>
                            </div>
                        </div>
                        <div class="message text-only">
                            <div class="response">
                                <p class="text"> When can we meet ?</p>
                            </div>
                        </div>
                        <p class="response-time time"> 15h04</p>
                        <div class="message">
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text"> 9 pm at the bar if possible 😳</p>
                        </div>
                        <p class="time"> 15h09</p>
                    </div>
                    <form action="#" class="footer-chat">
                        <i class="icon fa-solid fa-smile clickable" style="font-size:25pt;" aria-hidden="true"></i>

                        <input type="text" class="write-message" id="messsage" name="message" placeholder="Type your message here"></input>
                        <a class="button"><i class="icon send fa-solid fa-paper-plane clickable"></i></a>
                    </form>

                </section>
                <section class="client_profile">

                    <div class="container">
                        <div class="team-single">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 xs-margin-30px-bottom">
                                    <div class="team-single-img">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" width="150">
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-7">
                                    <div class="team-single-text padding-50px-left sm-no-padding-left">
                                        <h4 class="font-size38 sm-font-size32 xs-font-size30">Buckle Giarza</h1>
                                            <h6 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600">Class Teacher
                                        </h4>
                                        <ul>
                                            <li>Age:</li>
                                            <li>Location:</li>
                                            <li>Height:</li>
                                            <li>Weight:</li>
                                        </ul>
                                        

                                    </div>
                                </div>
                                
                                <p>I am interested in ladies between: 18-27 years old</p>
                                <h4>Profile Basics</h4>
                                <div class="col-lg-6">
                                    
                                        <ul class="list-style9 no-margin">
                                            <li>
                                                Body Type:
                                            </li>
                                            <li>
                                                Hair Color:
                                            </li>
                                            <li>
                                                Eyes Color:
                                            </li>
                                            <li>
                                                Ethnicity:
                                            </li>
                                            <li>
                                                Marital Status:
                                            </li>
                                            <li>
                                                Smoking:
                                            </li>
                                   
                                            
                                          
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                    
                                        <ul class="list-style9 no-margin">
                              
                                            <li>
                                                Drinking:
                                            </li>
                                            <li>
                                                Religion:
                                            </li>
                                            <li>
                                                Education:
                                            </li>
                                            <li>
                                                Children:
                                            </li>
                                            <li>
                                                Number of children:
                                            </li>
                                            
                                          
                                        </ul>
                                    </div>

                                    <h5 class="font-size24 sm-font-size22 xs-font-size20">About me</h5>

                                    <ul>
                                        <li>
                                            Employment:
                                        </li>
                                        <li>
                                            Describe Yourself (Hobby's and Interest):
                                        </li>
                                        <li>
                                            Your Ideal Match (About Her):
                                        </li>
                                        <li>
                                            Additional comments: 
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#send").on("click", function() {
                $.ajax({
                    url: "insertMessage.php",
                    method: "POST",
                    data: {
                        fromUser: $("#fromUser").val(),
                        toUser: $("#toUser").val(),
                        message: $("#message").val()
                    },
                    dataType: "text",
                    success: function() {
                        $("#message").val("");
                        loadMessages(); // Reload messages after sending
                    }
                });
            });

            function loadMessages() {
                $.ajax({
                    url: "realTimeChat.php",
                    method: "POST",
                    data: {
                        fromUser: $("#fromUser").val(),
                        toUser: $("#toUser").val()
                    },
                    dataType: "text",
                    success: function(data) {
                        $("#msgBody").html(data);
                    }
                });
            }

            // Load messages periodically
            setInterval(loadMessages, 700);
        });
    </script>



    <?php require('partials/footer.php') ?>
<?php else : require base_path('views/session/create.view.php') ?>

<?php endif


?>