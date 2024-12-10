<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seats</title>

    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">



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

        .white {
            background-color: white;
            border: none;
            font-size: 20px;
        }

        .container-p {
            /* border: 1px solid black; */
            width: 50%;
            margin: auto;
            text-align: center;
            margin-top: 100px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .fs {
            font-size: 13px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-light py-2 d-flex">
        <div class="container px-3">
            <span class="navbar-brand mb-0 h1 p-3">
                <h4>TicketMax</h4>
            </span>
            <div class="dropdown border-0">
                <button class="btn dropdown-toggle border-0" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span style="text-align:center">
                        <p style="margin:0px"><i class="fa-solid fa-user fs-4"></i></p>
                        <?= session('data')->email ?>
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
    <div class="cancel m-3">
    <button class="btn btn-danger"><a href="/"><i class="fa-solid fa-x"></i></a></button>
    </div>

    <div class="container-p shadow p-3 bg-body rounded">
        <input type="hidden" name="id" id="movieid" value="<?= $id ?>">
        <?php for ($i = 0; $i < count($seats); $i++): ?>
            <?php for ($j = 0; $j < count($seats[array_keys($seats)[$i]]); $j++): ?>
                <?php
                if (in_array(array_keys($seats)[$i] . $j + 1, $reservedSeats)) {
                    echo "<button class=\"white\" disabled=true><i class=\"fa-solid fa-couch\"></i><p class=\"fs\">" . array_keys($seats)[$i] . $j + 1 . "</p></button>";
                } else {
                    echo "<button style=\"color:black\" class=\"boxes white\" name=\"seatsboxes\" value=" . array_keys($seats)[$i] . $j + 1 . "><i class=\"fa-solid fa-couch\"></i></i><p class=\"fs\">" . array_keys($seats)[$i] . $j + 1 . "</p></button>";
                }
                ?>

            <?php endfor; ?>
            <br>
        <?php endfor; ?>
    </div>

    <button class="btn btn-danger d-flex gap-2 font-bold submit" style="margin:auto; margin-top:40px">
        <strong>Price</strong>
        <h5 id="price"> 0</h5>
    </button>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script>

    var boxes = document.querySelectorAll('.boxes')

    selectedSeats = []

    price = 0

    price_tag = document.getElementById('price')

    boxes.forEach((box) => {
        box.addEventListener('click', () => {

            console.log(box.value)

            if (box.style.color == 'black') {
                box.style.color = 'red'
                price += 200
            }
            else {
                box.style.color = 'black'
                price -= 200
            }

            price_tag.innerText = price

            if (box.style.color == 'red') {
                selectedSeats.push(box.value)
            }
            else {
                var index = selectedSeats.indexOf(box.value)
                selectedSeats.splice(index, 1)
            }

            // if (box.checked == true) {
            //     selectedSeats.push(box.value)
            // }
            // else {
            //     if (selectedSeats != []) {
            //         var index = selecteSeats.indexOf(box.value)
            //         selectedSeats.splice(index, 1)
            //     }
            // }
        })
    })

    document.querySelector('.submit').addEventListener('click', function (e) {
        e.preventDefault()
        var seatstring = selectedSeats.join("_")
        id = document.getElementById("movieid").value
        console.log(seatstring)
        console.log(price)
        window.location.href = `http://localhost:8080/postbooking?movieId=${id}&bookedSeats=${seatstring}&price=${price}`
    })

</script>

</html>