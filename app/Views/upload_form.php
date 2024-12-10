<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<body>

    <div class="container mt-3">
        <form class="w-50 m-auto" action="/upload-movie" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Movie Poster</label>
                <input name="imagefile" class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Movie Title</label>
                <input name="movietitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    value="<?= old('movietitle') ?>">
                <p><?= session()->getFlashdata('message') ?></p>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>


</html>