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

    <div class="container w-75 my-3">
        <?php
        // $searchResults = $_GET["search"];
        // $sql = "SELECT * FROM `threads` WHERE thread_title LIKE '%$searchResults%';";
        // // $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title, thread_desc) AGAINST ('$searchResults');";
        // $result = mysqli_query($con, $sql);
        // $noResult = true;

        // echo '<h1>Search Results for "' . $searchResults . '"</h1>';

        // while ($row = mysqli_fetch_assoc($result)) {
        //     $noResult = false;
        //     $id = $row['thread_id'];
        //     $title = $row['thread_title'];
        //     $desc  = $row['thread_desc'];
        //     $user_id = $row['thread_user_id'];
        //     $thread_time = $row['timestamp'];
        //     $sql = "SELECT * FROM `users` WHERE user_id =$user_id;";
        //     $result = mysqli_query($con, $sql);
        //     $row = mysqli_fetch_assoc($result);
        //     $str = $row["user_email"];
        //     $username  = substr($str, 0, strpos($str, '@'));

        //             echo '<div class="d-flex my-3">
        //        <div class="flex-shrink-0">
        //            <img src="img/user.png" width="64px" height="64px" class="align-self-start mr-3" alt="...">
        //        </div>
        //        <div class="flex-grow-1 ms-3">
        //        <p class="fw-bold my-0">' . $username . ' <span class="float-end"> ' . $thread_time . ' </span></p>
        //            <h5 class="mt-0"><a class="text-decoration-none" href="threads.php?thread_id=' . $id . '">' . $title .  '</a></h5>
        //            ' . $desc . '
        //        </div>
        //    </div>';
        // }
        $searchResults = $_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE thread_title LIKE '%$searchResults%' OR thread_desc LIKE '%$searchResults%'";
        // $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) AGAINST ('$searchResults')";
        $result = mysqli_query($con, $sql);
        $noresults = true;
        echo '<h1>Search Results for "' . $searchResults . '"</h1>';

        while ($row = mysqli_fetch_assoc($result)) {
            $noresults = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc  = $row['thread_desc'];


            echo '<div class="d-flex my-3">
                   <div class="flex-shrink-0">
                       <img src="img/user.png" width="64px" height="64px" class="align-self-start mr-3" alt="...">
                   </div>
                   <div class="flex-grow-1 ms-3">

                       <h5 class="mt-0"><a class="text-decoration-none" href="threads.php?thread_id=' . $id . '">' . $title .  '</a></h5>
                       ' . $desc . '
                   </div>
               </div>';
        }
        if ($noresults) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead"> Suggestions: <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords. </li></ul>
                        </p>
                    </div>
                 </div>';
        }


        ?>

        <div class="container-fluid w-100 mt-5 position-absolute bottom-0 start-50 translate-middle-x"
            style="--bs-gutter-x: 0;">
            <?php include "partials/_footer.php" ?></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>