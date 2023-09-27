<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "_dbconnect.php";
    $userEmail = $_POST["signupEmail"];
    $Pass = $_POST["signupPass"];
    $cPass = $_POST["signupConfirmPass"];

    $existUser = "SELECT * FROM `users` WHERE user_email = '$userEmail'";
    $result = mysqli_query($con, $existUser);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        $showError = "Email alredy exists";
        // header("Location: /index.php?signupSuccess=false&error=$showError");
        header("Location: /forum/index.php?signupSuccess=false&error=$showError");
    } else {
        if ($Pass == $cPass) {
            $hash = password_hash($Pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `timestamp`) VALUES ('$userEmail', '$hash', current_timestamp());";
            $result = mysqli_query($con, $sql);
            if ($result) {
                // header("Location: /index.php?signupSuccess=true");
                header("Location: /forum/index.php?signupSuccess=true");
                exit();
            }
        } else {
            $showError = "Password donot match";
            // header("Location: /index.php?signupSuccess=false&error=$showError");
            header("Location: /forum/index.php?signupSuccess=false&error=$showError");
        }
    }
}
