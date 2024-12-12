<nav class="navbar bg-light py-2 d-flex sticky-top">
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
                    <span style="font-size:14px;"><?= session('data')->email ?></span>
                </span>
            </button>
            <ul class="dropdown-menu text-center">
                <?= session('role') == 'admin' ? '<li class="p-1"><strong>Admin</strong></li>' : "" ?>
                <li class="p-1">
                    <?= session('role') == 'user' ? "<a href=\"/showmytickets/" . session('data')->_id . "\">My Tickets</a>" : " " ?>
                </li>
                <?= session('role') == 'admin' ? '<li class="p-1"><a href="/upload-form" style="text-decoration:none">Add Movie</a></li>' : "" ?>
                <?= session('role') == 'admin' ? '<li class="p-1"><a href="/alltickets" style="text-decoration:none">View All Tickets</a></li>' : "" ?>
                <?= session('role') == 'admin' ? '<li class="p-1"><a href="/logs" style="text-decoration:none">View Logs</a></li>' : "" ?>
                <li class="p-1"><?= session('data') ? "<a href=\"/logout\" >Logout</a>" : "" ?>
                </li>
            </ul>
        </div>

    </div>
    <div>
    </div>
</nav>