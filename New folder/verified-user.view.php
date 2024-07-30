<?php
require base_path('Http/controllers/chat/config.php');

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
            $_SESSION['unique_id'] = $user['id'];
            break; // Exit the loop once the user is found
        }
    }

    // Free result set
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
} else {
    echo "Error executing query: " . mysqli_error($conn);
} ?>


<?php require('partials/head.php') ?>
<?php if ($_SESSION['user'] ?? false) : ?>
    <?php require('partials/sidebar.php') ?>
    <?php require('partials/nav.php') ?>
    <?php if ($roleId != 2) {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You have no access to this page.'
        }).then(function() {
            window.history.back(); // Go back to the previous page
        });
      </script>";


        exit;
    } ?>
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

    <?php $user_id = $_SESSION['unique_id']; ?>
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
                    <div class="discussion message-active">
                        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Megan Leib</p>
                            <p class="message">9 pm at the bar if possible 😳</p>
                        </div>
                        <div class="timer">12 sec</div>
                    </div>

                    <div class="discussion">
                        <div class="photo" style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Dave Corlew</p>
                            <p class="message">Let's meet for a coffee or something today ?</p>
                        </div>
                        <div class="timer">3 min</div>
                    </div>

                    <div class="discussion">
                        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1497551060073-4c5ab6435f12?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=667&amp;q=80);">
                        </div>
                        <div class="desc-contact">
                            <p class="name">Jerome Seiber</p>
                            <p class="message">I've sent you the annual report</p>
                        </div>
                        <div class="timer">42 min</div>
                    </div>

                    <div class="discussion">
                        <div class="photo" style="background-image: url(https://card.thomasdaubenton.com/img/photo.jpg);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Thomas Dbtn</p>
                            <p class="message">See you tomorrow ! 🙂</p>
                        </div>
                        <div class="timer">2 hour</div>
                    </div>

                    <div class="discussion">
                        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1553514029-1318c9127859?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=700&amp;q=80);">
                        </div>
                        <div class="desc-contact">
                            <p class="name">Elsie Amador</p>
                            <p class="message">What the f**k is going on ?</p>
                        </div>
                        <div class="timer">1 day</div>
                    </div>

                    <div class="discussion">
                        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1541747157478-3222166cf342?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=967&amp;q=80);">
                        </div>
                        <div class="desc-contact">
                            <p class="name">Billy Southard</p>
                            <p class="message">Ahahah 😂</p>
                        </div>
                        <div class="timer">4 days</div>
                    </div>

                    <div class="discussion">
                        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1435348773030-a1d74f568bc2?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Paul Walker</p>
                            <p class="message">You can't see me</p>
                        </div>
                        <div class="timer">1 week</div>
                    </div>
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
                        <input type="hidden" class="incoming_id" value="<?php echo $user_id ?>"></input>
                        <input type="text" class="write-message" placeholder="Type your message here"></input>
                        <a class="button"><i class="icon send fa-solid fa-paper-plane clickable"></i></a>
                    </form>

                </section>
            </div>
        </div>
    </main>
    <script src="Http/controllers/chat/chat.js"></script>


    <?php require('partials/footer.php') ?>
<?php else : require base_path('views/session/create.view.php') ?>

<?php endif ?>