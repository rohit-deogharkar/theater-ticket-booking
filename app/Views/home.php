<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">

    <script src="<?= base_url('/js/bootstrap.min.js') ?>"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
</head>

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
            <?= session('role') == 'admin' ? "<button><a href=\"/upload-form\" style=\"text-decoration:none\">Add Movie</a></button>" : "" ?>
            <button> <a href="/showmytickets/<?= session('data')->_id ?>">My Tickets</a></button>
            <?= session('data') ? " <button> <a href=\"/logout\">Logout</a></button>" : "" ?>
        </div>
        <div>
        </div>
    </nav>
    <div class="mx-5 mt-4 d-flex justify-content-between flex-wrap">
        <?php foreach ($movies as $movie): ?>
            <div class="card mb-4" style="width: 18rem;" data-id="<?= $movie->_id ?>">
                <img src="<?= base_url('pictures/' . $movie->imagename) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-title">
                        <h5><?= $movie->title ?></h5>
                    </div>
                    <p class="card-text"><?= $movie->releasedate ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>

<script>

    const nodelist = document.querySelectorAll('.card')

    nodelist.forEach((element) => {
        element.addEventListener('click', () => {
            const id = element.getAttribute('data-id')
            window.location.href = `http://localhost:8080/movie-details/${id}`
        })
    });

</script>

</html>