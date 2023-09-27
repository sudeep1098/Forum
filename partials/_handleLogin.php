<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "_dbconnect.php";
    $userEmail = $_POST["loginEmail"];
    $Pass = $_POST["loginPass"];

    $existUser = "SELECT * FROM `users` WHERE user_email = '$userEmail'";
    $result = mysqli_query($con, $existUser);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($Pass, $row['user_password'])) {
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['userEmail'] = $userEmail;
        } else {
            $showError = "Invalid username or password";
            // header("Location: /index.php?loginSuccess=false&error=$showError");
            header("Location: /forum/index.php?loginSuccess=false&error=$showError");
        }
    } else {
        $showError = "Invalid username or password";
        // header("Location: /index.php?loginSuccess=false&error=$showError");
        header("Location: /forum/index.php?loginSuccess=false&error=$showError");
    }
    // header("Location: /index.php");
    header("Location: /forum/index.php");
}
