<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<body>

    <nav class="navbar bg-light py-2 d-flex">
        <div class="container-fluid px-3">
            <span class="navbar-brand mb-0 h1 p-3">TicketMax</span>
            <button><a href="/" style="text-decoration:none">Home</a></button>
        </div>
        <div>
        </div>
    </nav>

    <div class="container mt-3">
        <form class="w-50 m-auto" action="/upload-movie" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Movie Poster</label>
                <input name="imagefile" class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Movie Title</label>
                <input name="movietitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= old('movietitle')?>">
                <p><?= session()->getFlashdata('message')?></p>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Director's Name</label>
                <input name="director" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Language</label>
                <input name="language" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Release Date</label>
                <input type="date" name="releasedate" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Genre Name</label>
                <input name="moviegenre" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Movie Description</label>
                <textarea class="form-control" name="description" id=" floatingTextarea"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>



</html>