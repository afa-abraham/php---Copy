<?php


use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$users = $db->query('select * from users')->get();
 foreach ($users as $user) {
    if ($user['email'] === $_SESSION['user']['email']) {
        $roleId = $user['role_id'];
        break;
    }
}


$db->query('UPDATE users SET first_name = :first_name, middle_name = :middle_name, last_name= :last_name, age = :age, birthdate = :birthdate, marital_status = :marital_status, mobile= :mobile, fb_link=:fb_link,img=:img,videos=:videos WHERE email=:email ',[
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name'],
    'age' => $_POST['age'],
    'birthdate' => $_POST['birthdate'],
    'marital_status' => $_POST['marital_status'],
    'mobile' => $_POST['mobile'],
    'fb_link' => $_POST['fb_link'],
    'img' => $_POST['img'],
    'videos' => $_POST['videos'],
    'email' => $_SESSION['user']['email']
]);



if(isset($_POST['upload_btn']))
{
    $image = $_FILES['img']['name'];
    $path = "uploads/"; /* Path for Uploading your Image */
    $image_extension = pathinfo($image,PATHINFO_EXTENSION); /* Image Extension */
    $filename = time().'.'.$image_extension; /* Renaming the Image */

    $db->query("INSERT INTO users (img) VALUES ('$filename')");

    move_uploaded_file($_FILES['img']['tmp_name'],$path."/".$filename);

    $_SESSION['status'] = 'Image User Profile Uploaded Successfully';
    header('Location: ' . ($roleId == 3 ? '/' : ($roleId == 2 ? '/verified-user' : '/admin')));
    exit();
} else 
{
    $_SESSION['status'] = 'Something went wrong';
    header('Location: ' . ($roleId == 3 ? '/' : ($roleId == 2 ? '/verified-user' : '/admin')));
    exit();
}


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $targetDir = "uploads/";
//     if (!is_dir($targetDir)) {
//         mkdir($targetDir, 0777, true);
//     }

//     // Find the next available directory
//     $nextDir = 1;
//     while (is_dir($targetDir . $nextDir)) {
//         $nextDir++;
//     }

//     $uploadDir = $targetDir . $nextDir . "/";
//     mkdir($uploadDir, 0777, true);

//     $targetFile = $uploadDir . basename($_FILES["fileToUpload"]["name"]);
//     $uploadOk = 1;
//     $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

//     // Check if file is an actual image or video
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if ($check !== false || in_array($fileType, ['mp4', 'avi', 'mov', 'wmv'])) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image or a valid video format.";
//         $uploadOk = 0;
//     }

//     // Check file size (limit to 50MB)
//     if ($_FILES["fileToUpload"]["size"] > 50000000) {
//         echo "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     // Allow certain file formats
//     if (!in_array($fileType, ['jpg', 'png', 'jpeg', 'gif', 'mp4', 'avi', 'mov', 'wmv'])) {
//         echo "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, MOV, and WMV files are allowed.";
//         $uploadOk = 0;
//     }

//     // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//         echo "Sorry, your file was not uploaded.";
//     } else {
//         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
//             echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
//         } else {
//             echo "Sorry, there was an error uploading your file.";
//         }
//     }
// }

