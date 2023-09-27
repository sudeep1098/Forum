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
    <section class="py-5 my-5 rounded-3 bg-light text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold">About</h1>
                <p class="lead fw-light">A forum where you can ask and learn from other people and
                    get
                    solution to your problems.</p>
                <p>
                    <a href="contact.php" class="btn btn-primary my-2">Contact here</a>
                </p>
            </div>
        </div>
    </section>
    <div class="container-fluid w-100 mt-5 position-absolute bottom-0 start-50 translate-middle-x"
        style="--bs-gutter-x: 0;">
        <?php include "partials/_footer.php" ?></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>