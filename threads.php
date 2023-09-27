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
    <?php
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($con, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc  = $row['thread_desc'];
        $user_id = $row['thread_user_id'];
        $sql = "SELECT user_email FROM `users` WHERE user_id =$user_id;";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $str = $row["user_email"];
        $username  = substr($str, 0, strpos($str, '@'));
    }
    ?>

    <?php
    $showalert = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET['thread_id'];
        $content = $_POST['comment'];
        $content = str_replace("<",  "&lt;", $content);
        $content = str_replace(">",  "&gt;", $content);
        $user_id = $_POST["user_id"];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$content', '$id','$user_id', current_timestamp());";
        $result = mysqli_query($con, $sql);
        $showalert = true;
        if ($showalert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }


    ?>
    <div class="container w-75 my-3">
        <div class="p-3 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to <?php echo $title; ?> forum</h1>
                <p class="col-md-8 fs-4"><?php echo $desc; ?></p>
                <hr class="my-2">
                <p>Set field value based on formula, value from another field, and constant value.
                    Clear field values.
                    Make field required.
                    Show or hide fields.
                    Enable or disable fields.
                    Validate data and show error messages.
                    Change field instructions.</p>
                <p class="fw-bold">Posted by: <?php echo $username; ?></p>
            </div>
        </div>
    </div>
    <div class="container w-75">
        <h1>Post a comment</h1>
        <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            
            <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Type your comment</label>
            <input type="hidden" name="user_id" value="' . $_SESSION["user_id"] . '">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>';
        } else {
            echo '<div class="p-3 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">Login or Signup to ask questions.</h1>
                <p class="col-md-8 fs-4">Be the first to Comment.</p>
                </div>

            </div>';
        }
        ?>
    </div>


    <div class="container w-75 my-3">
        <h1>Discussion</h1>
        <?php
        $id = $_GET["thread_id"];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($con, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $content = $row["comment_content"];
            $time = $row["comment_time"];
            $user_id = $row["comment_by"];
            $sql2 = "SELECT user_email FROM `users` WHERE user_id =$user_id;";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $str = $row2["user_email"];
            $username  = substr($str, 0, strpos($str, '@'));

            echo '<div class="d-flex my-3 align-items-center">
       <div class="flex-shrink-0">
           <img src="img/user.png" width="64px" height="64px" class="align-self-start mr-3" alt="...">
       </div>
       <div class="flex-grow-1 ms-3">
           <p class="fw-bold my-0">' . $username . ' <span class="float-end"> ' . $time . ' </span></p>
           <p class="my-0 ">' . $content . '</p>
           
       </div>
   </div>';
        }
        if ($noResult) {
            echo '<div class="p-3 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">No Comments found</h1>
                <p class="col-md-8 fs-4">Be the first to comment.</p>
                </div>
            </div>';
        }

        ?>
    </div>

    <?php include "partials/_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>