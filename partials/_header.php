<?php

session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/forum">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Top Categories
                    </a>
                    <ul class="dropdown-menu">';
$sql = "SELECT * FROM `categories` LIMIT 3";
$result = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
    $catname = $row["category_name"];
    $catid = $row["category_id"];
    echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $catid . '">' . $catname . '</a></li>';
}
echo '</ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>';
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
    $str = $_SESSION["userEmail"];
    $username  = substr($str, 0, strpos($str, '@'));
    echo '<form class="d-flex" role="search" method="get" action="search.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <a href="partials/_logout.php" class="mx-2 btn btn-outline-success" type="submit">Logout</a>
                </form>
                <p class = "text-light mx-3 my-2 ">Welcome ' . $username . '</p>';
} else {
    echo '<form class="d-flex" role="search" method="get" action="search.php">
    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <div class="mx-2">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
            </div>';
}


echo '</div>
    </div>
</nav>';

include "partials/_loginmodal.php";
include "partials/_signupmodal.php";


if (isset($_GET['signupSuccess']) && ($_GET['signupSuccess'] == "true")) {

    echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account is signed up.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "false") {
    $showError = $_GET['error'];
    echo '<div class="alert alert-warning my-0 alert-dismissible fade show" role="alert">
        <strong>Failed to Signup!</strong> ' . $showError . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

if (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == "false") {
    $showError = $_GET['error'];
    echo '<div class="alert alert-warning my-0 alert-dismissible fade show" role="alert">
        <strong>Failed to Login!</strong> ' . $showError . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
