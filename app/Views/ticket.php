<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookMyShow Ticket</title>

    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">

    <script src="<?= base_url('/js/bootstrap.min.js') ?>"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>

    <script>

        <?php if (session()->has('cancellationSuccess')): ?>
            alert("<?= session()->getFlashdata('cancellationSuccess') ?>");
        <?php endif; ?>


    </script>
</body>

</html>