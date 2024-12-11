<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <?= session('data') ? " <button> <a href=\"/logout\">Logout</a></button>" : "" ?>
        </div>
        <div>
        </div>
    </nav>
    <div class="container w-25 shadow p-3 bg-body rounded" style="margin-top:180px">
        <form class="mb-3" action="/postlogin" method="post">
            <div class="mb-3 mt-2 text-center">
                <h3>Login</h3>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="<?= old('password') ?>">
            </div>
            <div class="erromessage text-center text-danger">
                <p><?= session()->getFlashdata('requiredfieldmessage') ?></p>
                <p><?= session()->getFlashdata('invalidloginmessage') ?></p>
            </div>
            <div class="container text-center w-3 mb-2">
                <input class="btn btn-primary" type="submit"><br>
        </form>
        <p class="mt-3">Don't have an account? <a style="text-decoration:none" href="/register">Register</a></p>
    </div>
</body>

</html>