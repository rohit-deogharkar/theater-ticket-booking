<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $movie->title ?></title>

    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">

    <script src="<?= base_url('/js/bootstrap.min.js') ?>"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Parkinsans', sans-serif;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-light py-2 d-flex">
        <div class="container-fluid px-3">
            <span class="navbar-brand mb-0 h1 p-3">TicketMax</span>
            <button><a href="/upload-form" style="text-decoration: none">Add Movie</a></button>
        </div>
        <div>

        </div>
    </nav>
    <div class="d-flex justify-content-center" style="margin-left:60px;">
        <img class="img-thumbnail" style="height:500px; margin: 60px 0px; margin-left:90px"
            src="<?= base_url('pictures/' . $movie->imagename) ?>" alt="">
        <div class="" style="width: 30rem; height:300px; margin: 130px 0px; margin-left:80px">
            <div class="card-body">
                <h1 class="card-title mb-2"><?= $movie->title ?></h1>
                <p><span class="card-subtitle text-muted">Genre:</span> <span><?= $movie->genre ?></span></p>
                <p><span class="card-subtitle text-muted">Director:</span> <span><?= $movie->director ?></span></p>
                <p><span class="card-subtitle text-muted">Language:</span> <span><?= $movie->language ?></span></p>
                <p><span class="card-subtitle text-muted">Release Date:</span> <span><?= $movie->releasedate ?></span>
                </p>
                <p><span class="card-subtitle text-muted">Description:</span> <span><?= $movie->description ?></span>
                </p>
            </div>
            <?php if (session('role') == 'admin'): ?>
                <div class="operations mt-3">
                    <button class="btn btn-danger">
                        <a href="/deletemovie/<?= $movie->_id ?>" style="text-decoration:none; color:white">
                            <i class="fa-solid fa-trash fs-5"></i>
                            <span>Delete Movie</span>
                        </a>
                    </button>
                    <button class="btn btn-warning" style="margin-left:10px">
                        <a href="/updateMovieDetails/<?= $movie->_id ?>" style="text-decoration:none; color:black">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Update Movie</span>
                        </a>
                    </button>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="book-ticket d-flex items-center">
        <button class="mx-auto btn btn-success fs-5"><a href="/booking/<?= $movie->_id ?>"
                style="text-decoration:none; color:white">Book Ticket</a></button>
    </div>
</body>

</html>