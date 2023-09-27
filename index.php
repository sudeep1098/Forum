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
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider1.jpg" class="d-block w-100" height="350" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider2.jpg" class="d-block w-100" height="350" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide3.jpg" class="d-block w-100" height="350" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php $sql = "SELECT * FROM `categories`;";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $catid = $row["category_id"];
                    $catname = $row["category_name"];
                    $catdesc = $row["category_desc"];
                    echo '<div class="col">

                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="https://source.unsplash.com/500x400/?' . $catname . ',code"  preserveAspectRatio="xMidYMid slice" focusable="false">
                        
                        </img>
                        <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid=' . $catid . '&page=1">' . $catname . '</a></h5>';
                    if (strlen($catdesc) > 50) {
                        echo '<p class="card-text">' . substr($catdesc, 0, 50) . '... </p>';
                    } else {
                        echo '<p class="card-text">' . $catdesc . '</p>';
                    }

                    echo '<a href="threadlist.php?catid=' . $catid . '&page=1" class="btn btn-primary">View threads</a>';

                    echo '</div>
                    </div>
                    </div>';
                }
                ?>
            </div>

        </div>
    </div>

    <?php include "partials/_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>