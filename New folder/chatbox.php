<?php
session_start();
include("DBConnection.php");
include("links.php");

// Prepare statement to get user info
$stmt = $connect->prepare("SELECT * FROM users WHERE Id = ?");
$stmt->bind_param("i", $_SESSION["userId"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Get the toUser from GET or session
$toUser = isset($_GET["toUser"]) ? $_GET["toUser"] : $_SESSION["toUser"];

// Prepare statement to get user names for selection
$userListStmt = $connect->prepare("SELECT * FROM users");
$userListStmt->execute();
$userList = $userListStmt->get_result();

// Prepare statement to get user name for modal header
$userNameStmt = $connect->prepare("SELECT * FROM users WHERE Id = ?");
if (isset($_GET["toUser"])) {
    $userNameStmt->bind_param("i", $_GET["toUser"]);
} else {
    $userNameStmt->bind_param("i", $_SESSION["toUser"]);
}
$userNameStmt->execute();
$uName = $userNameStmt->get_result()->fetch_assoc();
$_SESSION["toUser"] = $uName["Id"]; // Ensure session is updated
$userNameStmt->close();

// Prepare statement to get chat messages
$chatStmt = $connect->prepare("
    SELECT * FROM messages
    WHERE (FromUser = ? AND ToUser = ?) OR (FromUser = ? AND ToUser = ?)
");
$chatStmt->bind_param("ssss", $_SESSION["userId"], $toUser, $toUser, $_SESSION["userId"]);
$chatStmt->execute();
$chats = $chatStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <script src="path/to/jquery.js"></script>
    <script src="path/to/bootstrap.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <p>Hi <?php echo htmlspecialchars($user["User"], ENT_QUOTES, 'UTF-8'); ?></p>
                <input type="text" id="fromUser" value="<?php echo htmlspecialchars($user['Id'], ENT_QUOTES, 'UTF-8'); ?>" hidden>

                <p>Send message to:</p>
                <ul>
                    <?php while ($msg = $userList->fetch_assoc()) : ?>
                        <li><a href="?toUser=<?php echo htmlspecialchars($msg["Id"], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($msg["User"], ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <?php endwhile; ?>
                </ul>
                <a href="index.php">&lt;-- Back</a>
            </div>
            <div class="col-md-4">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>
                                <?php echo htmlspecialchars($uName["User"], ENT_QUOTES, 'UTF-8'); ?>
                                <input type="text" value="<?php echo htmlspecialchars($_SESSION["toUser"], ENT_QUOTES, 'UTF-8'); ?>" id="toUser" hidden />
                            </h4>
                        </div>
                        <div class="modal-body" id="msgBody" style="height:400px; overflow-y:scroll; overflow-x:hidden;">
                            <?php while ($chat = $chats->fetch_assoc()) : ?>
                                <?php
                                $message = htmlspecialchars($chat["Message"], ENT_QUOTES, 'UTF-8');
                                if ($chat["FromUser"] == $_SESSION["userId"]) :
                                ?>
                                    <div style='text-align:right;'>
                                        <p style='background-color:lightblue; word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;'>
                                            <?php echo $message; ?>
                                        </p>
                                    </div>
                                <?php else : ?>
                                    <div style='text-align:left;'>
                                        <p style='background-color:yellow; word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;'>
                                            <?php echo $message; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                        <div class="modal-footer">
                            <textarea name="message" id="message" class="form-control" style="height:70px;"></textarea>
                            <button id="send" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>

</html>