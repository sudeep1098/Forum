<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "partials/_dbconnect.php" ?>
    <?php include "partials/_header.php" ?>
    <?php
    $id = $_GET["catid"];
    $sql = "SELECT * FROM categories WHERE category_id=$id";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row["category_name"];
        $catdesc = $row["category_desc"];
    }
    ?>

    <?php
    $showalert = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET['catid'];
        $title = $_POST['title'];
        $title = str_replace("<",  "&lt;", $title);
        $title = str_replace(">",  "&gt;", $title);
        $desc = $_POST['desc'];
        $desc = str_replace("<",  "&lt;", $desc);
        $desc = str_replace(">",  "&gt;", $desc);
        $user_id = $_POST["user_id"];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$desc', '$id', '$user_id', current_timestamp());";
        $result = mysqli_query($con, $sql);
        $showalert = true;
        if ($showalert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added please wait for community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }


    ?>

    <?php
    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT user_email FROM `users` WHERE user_id =$user_id;";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $str = $row["user_email"];
        $username  = substr($str, 0, strpos($str, '@'));
    }
    ?>
    <div class="container w-75 my-3">
        <div class="p-3 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to <?php echo $catname; ?> forum</h1>
                <p class="col-md-8 fs-4"><?php echo $catdesc; ?></p>
                <hr class="my-2">
                <p>Set field value based on formula, value from another field, and constant value.
                    Clear field values.
                    Make field required.
                    Show or hide fields.
                    Enable or disable fields.
                    Validate data and show error messages.
                    Change field instructions.</p>
                <p class="fw-bold">Posted by: <?php echo $username; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="container w-75">
        <h1>Start a discussion</h1>
        <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            echo '
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Project Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Keep your title as short as possible.</div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"
                style="height: 100px"></textarea>
            <label for="floatingTextarea2">Elaborate your concern</label>
        </div>
        <input type="hidden" name="user_id" value="' . $_SESSION["user_id"] . '">

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>';
        } else {
            echo '<div class="p-3 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">Login or Signup to ask questions.</h1>
                <p class="col-md-8 fs-4">Be the first to ask your question.</p>
                </div>

            </div>';
        }

        ?>
    </div>


    <div class="container w-75 my-3">
        <h1>Browse questions</h1>
        <?php
        $id = $_GET["catid"];
        $itemsPerPage = 3; // Number of items to display per page
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Query to get all threads for the category (without LIMIT)
        $sqlTotal = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        $resultTotal = mysqli_query($con, $sqlTotal);
        $totalThreads = mysqli_num_rows($resultTotal);

        // Query to get a specific page of items
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id LIMIT $offset, $itemsPerPage";
        $result = mysqli_query($con, $sql);
        $noResult = true;
        $numrows = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thread_id = $row["thread_id"];
            $title = $row["thread_title"];
            $desc = $row["thread_desc"];
            $thread_time = $row["timestamp"];
            $user_id = $row["thread_user_id"];
            $sql2 = "SELECT user_email FROM `users` WHERE user_id = $user_id;";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $str = $row2["user_email"];
            $username  = substr($str, 0, strpos($str, '@'));

            echo '<div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="img/user.png" width="64px" height="64px" class="align-self-start mr-3" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <p class="fw-bold my-0">' . $username . ' <span class="float-end"> ' . $thread_time . ' </span></p>
                <h5 class="mt-0"><a class="text-decoration-none" href="threads.php?thread_id=' . $thread_id . '">' . $title .  '</a></h5>
                ' . $desc . '
            </div>
        </div>';
        }

        // Pagination
        if ($totalThreads > $itemsPerPage) {
            echo '<nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">';
            if ($currentPage > 1) {
                echo '<li class="page-item">
                <a href="threadlist.php?catid=' . $id . '&page=' . ($currentPage - 1) . '" class="page-link">Previous</a>
            </li>';
            }

            for ($page = 1; $page <= ceil($totalThreads / $itemsPerPage); $page++) {
                echo '<li class="page-item ' . ($page == $currentPage ? 'active' : '') . '">
              <a class="page-link" href="threadlist.php?catid=' . $id . '&page=' . $page . '">' . $page . '</a>
          </li>';
            }

            if ($currentPage < ceil($totalThreads / $itemsPerPage)) {
                echo '<li class="page-item">
                    <a class="page-link" href="threadlist.php?catid=' . $id . '&page=' . ($currentPage + 1) . '">Next</a>
                </li>';
            }
            echo '</ul>
      </nav>';
        }
        if ($noResult) {
            echo '<div class="p-3 mb-4 bg-body-tertiary rounded-3">
<div class="container-fluid py-3">
    <h1 class="display-5 fw-bold">No Threads found</h1>
    <p class="col-md-8 fs-4">Be the first to ask your question</p>
   </div>
</div>';
        }
        ?>
    </div>

    <?php include "partials/_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>