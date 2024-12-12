<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
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

    <div class="container w-75 mt-5">
        <table class="table table-striped text-center border">
            <?php if (count($logs) > 0): ?>
                <thead class="fw-bold">
                    <tr>
                        <td>Email</td>
                        <td>Login</td>
                        <td>Logout</td>
                        <td>View Actions in this session</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= $log->email ?></td>
                            <td><?= $log->logInTime ?></td>
                            <td><?= $log->logOutTime == " " ? "Ongoing session" : $log->logOutTime ?></td>
                            <td><button class="btn btn-danger p-0 w-25"><a style="color:white"
                                        href="/specificlog/<?= $log->_id ?>">View</a></button>

                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div>
                        <h3 class="text-center">No Logs to show</h3>
                    </div>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>

</html>