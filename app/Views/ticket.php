<!DOCTYPE html>
<html lang="en" style="font-family: 'Parkinsans', sans-serif;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Ticket</title>
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body style="font-family: 'Parkinsans', sans-serif;">

    <table width="50%" cellpadding="0" cellspacing="0"
        style="background-color: #f4f4f4; max-width: 600px; margin: 50px auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 20px; overflow: hidden;">
        <tr>
            <td style="background-color: #dc3545; color: white; padding: 15px;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2" style="font-size: 20px; font-weight: bold;">Movie Ticket</td>
                        <td colspan="1" style="color: #212529; border-radius: 5px; width:100px">
                            <span
                                style="font-weight: bold; background-color: #f8f9fa; width:100px; border-radius: 5px; padding:4px"><?= $ticket->status ?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: white; padding: 20px;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="33%" style="padding-right: 10px;">
                            <img src="<?= base_url('pictures/' . $ticket->movieimage) ?>" alt="Movie Poster"
                                style="max-width: 100%; border-radius: 8px;">
                        </td>
                        <td width="67%" style="vertical-align: top; padding-left: 10px;">
                            <h2 style="margin: 0 0 15px 0;"><?= $ticket->movieName ?></h2>

                            <table width="100%" cellspacing="0" style="margin-top: 10px;">
                                <tr>
                                    <td width="10%" style="font-weight: bold;">Email:</td>
                                    <td width="50%"><?= $ticket->email ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Date:</td>
                                    <td>15 December 2024</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Time:</td>
                                    <td>07:30 PM</td>
                                <tr>
                                    <td colspan="1" style="font-weight: bold;">Theater:</td>
                                    <td colspan="2"> SlashRTC, Chandivali</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Screen:</td>
                                    <td>Screen 5</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Seats:</td>
                                    <td><?= implode(',', $ticket->seats) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width:20%">Ticket Type:</td>
                                    <td>Premium</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Price:</td>
                                    <td><?= $ticket->price ?></td>
                                </tr>
                            </table>


                        </td>
                    </tr>
                </table>

                <hr style="border: none; border-top: 1px solid #ddd; margin: 15px 0;">

                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align: center; color: #6c757d; font-size: 0.8rem;">
                            Enjoy your movie! No outside food or drinks allowed.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>

        </tr>
    </table>


    </td>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>


</html>