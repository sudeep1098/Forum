<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>
    <div class="container container_fluid w-50">
        <?php

        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            $email = $_SESSION["userEmail"];

            $showalert = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userEmail = $_POST["contactEmail"];
                $message = $_POST["message"];

                $sql = "INSERT INTO `contact` (`user_email`, `message`, `timestamp`) VALUES ('$userEmail', '$message', current_timestamp());";
                $result = mysqli_query($con, $sql);
                $showalert = true;
                if ($showalert) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your message has been sent please wait for owner to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong> Please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
                }
            }
            echo '<form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <h1 class="mt-5 text-center">Contact</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="contactEmail" value="' . $email . '" name="contactEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 100px"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Submit</button>
            </div>
        </form>';
        } else {
            echo '<div class="p-3 mt-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">Login or Signup to Contact.</h1>
                <p class="col-md-8 fs-4">We will help to fix your problems.</p>
            </div>

        </div>';
        }
        ?>
    </div>
    <div class="container-fluid w-100 mt-5 position-absolute bottom-0 start-50 translate-middle-x"
        style="--bs-gutter-x: 0;">
        <?php include "partials/_footer.php" ?></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>