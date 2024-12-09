<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        .ticket-header {
            color: white;
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- <div class="container w rounded"> -->
    <?php foreach ($tickets as $ticket): ?>
        <div class="container w-50">
            <div class="card my-3">
            <div class="ticket-header d-flex justify-content-between align-items-center rounded" style=" background-color: <?= $ticket->status == 'Confirmed' ?  '#ffc107' : '#dc3545' ?>">
                    <span class="badge bg-light text-dark">
                        <h6 style="margin-bottom:0px;"><?= $ticket->status ?></h6>
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $ticket->movieName ?></h5>
                    <div class="d-flex">
                        <img class="shadow bg-body rounded" style="width:100px"
                            src="<?= base_url('pictures/' . $ticket->movieimage) ?>" alt="">
                        <div class="m-4">
                        <p class="card-text"><strong>user email : </strong><?= $ticket->email ?> </p>
                            <p class="card-text">December 9 | 2.30pm | SlashRTC, Chandivali </p>
                            <a href="/ticket/<?= $ticket->_id?>" class="btn <?= $ticket->status == 'Confirmed' ?  'btn-warning' : 'btn-danger' ?> ">View Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <!-- </div> -->
</body>

</html>