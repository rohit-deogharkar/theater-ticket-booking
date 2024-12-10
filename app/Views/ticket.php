<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Ticket</title>

    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Parkinsans', sans-serif;
        }

        .ticket-container {
            max-width: 600px;
            margin: 50px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            background-color: #dc3545;
            color: white;
            padding: 15px;
        }

        .ticket-body {
            background-color: white;
            padding: 20px;
        }

        .movie-poster {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .ticket-details {
            margin-top: 20px;
        }

        .qr-code {
            max-width: 150px;
            margin-top: 15px;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-light py-2 d-flex">
        <div class="container px-3">
            <span class="navbar-brand mb-0 h1 p-3 flex-grow-1">
                <h4>TicketMax</h4>
            </span>
            <button class="btn btn-light"><a href="/"><i class="fa-solid fa-house"></i> Home</a></button>
            <div class="dropdown border-0">
                <button class="btn dropdown-toggle border-0 fs-6" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="fs-6" style="text-align:center; font-size:5px;">
                        <p style="margin:0px"><i class="fa-solid fa-user fs-6"></i></p>
                        <span  style="font-size:14px;"><?= session('data')->email ?></span>
                    </span>
                </button>
                <ul class="dropdown-menu text-center">
                    <li class="p-1"> <a href="/showmytickets/<?= session('data')->_id ?>">My
                            Tickets</a></li>
                    <li class="p-1"><?= session('data') ? "<a href=\"/logout\" >Logout</a>" : "" ?>
                    </li>
                </ul>
            </div>
            <?= session('role') == 'admin' ? "<button><a href=\"/upload-form\" style=\"text-decoration:none\">Add Movie</a></button>" : "" ?>
        </div>
        <div>
        </div>
    </nav>
    <div class="container ">
        <div class="ticket-container border rounded-5">
            <div class="ticket-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Movie Ticket</h3>
                <span class="badge bg-light text-dark"> <?= $ticket->status ?></span>
            </div>
            <div class="ticket-body">
                <div class="row">
                    <div class="col-4">
                        <img src="<?= base_url('pictures/' . $ticket->movieimage) ?>" alt="Movie Poster"
                            class="movie-poster">
                    </div>
                    <div class="col-8">
                        <h2 class="mb-3"><?= $ticket->movieName ?></h2>
                        <div class="ticket-details">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <strong>Email: </strong>
                                    <p class="mb-0"><?= $ticket->email ?></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <strong>Date:</strong>
                                    <p class="mb-0">15 December 2024</p>
                                </div>
                                <div class="col-6">
                                    <strong>Time:</strong>
                                    <p class="mb-0">07:30 PM</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <strong>Theater:</strong>
                                    <p class="mb-0">SlashRTC, Chandivali</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <strong>Screen:</strong>
                                    <p class="mb-0">Screen 5</p>
                                </div>
                                <div class="col-6">
                                    <strong>Seats:</strong>
                                    <p class="mb-0">
                                        <?= implode(",", $ticket->seats) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <strong>Ticket Type:</strong>
                                    <p class="mb-0">Premium</p>
                                </div>
                                <div class="col-6">
                                    <strong>Price</strong>
                                    <p class="mb-0">Rs. <?= $ticket->price ?>/- </p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <img src="<?= base_url('/images/qr.png') ?>" alt="QR Code" class="qr-code">
                            <p class="text-muted small mt-2">Booking ID: BMS24681357</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row text-center">
                    <div class="col-12">
                        <p class="text-muted small mb-0">
                            Enjoy your movie! No outside food or drinks allowed.
                        </p>
                    </div>
                </div>
            </div>
            <?= $ticket->status == 'Confirmed' ?
                "<div class=\"book-ticket d-flex items-center\">
            <button onclick=\"confirmFunction()\" class=\"mx-auto btn btn-danger fs-5\"><a  href=\"/cancel-ticket/$ticket->_id\" style=\"text-decoration:none; color:white\">Cancel Ticket
                </a></button>
        </div>" : "";
            ?>

        </div>

    </div>

    <!-- Bootstrap 5.2 JS Bundle (optional) -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

    <script>

        <?php if (session()->has('cancellationSuccess')): ?>
            alert("<?= session()->getFlashdata('cancellationSuccess') ?>");
        <?php endif; ?>

        // addEventListener('popstate',()=>{location.reload()})

    </script>
</body>

</html>