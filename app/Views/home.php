<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    body {
        font-family: 'Parkinsans', sans-serif;
    }

    a {
        text-decoration: none;
        color: black;
    }
</style>

</head>

<body>

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>

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