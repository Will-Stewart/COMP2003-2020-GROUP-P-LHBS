<!DOCTYPE html>
<html lang="en">
<head>
    <title>Llafan Hotel Booking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>




<body>

    <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #8B0808;">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="img/talyllyn-logo.png" width="228" height="66" alt="logo">
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="loginUser.php">User Login</a>
                </li>
                <li class="nav-item" style="align-items: center">
                    <a class="nav-link" href="loginAdmin.php">Admin Login</a>
                </li>
            </ul>
        </div>



        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="#">LHBS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    <section class="showcase">
        <div>
        <img src="img/demo-image.jpg" alt="boat" style="width:100%;min-height:350px;max-height:800px;">
        </div>
    </section>


    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">About The Llechfan Hostel Booking System</h1>



        <!-- Intro Content -->
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid rounded mb-4" src="img/index-demo1.jpg" alt="">
            </div>
            <div class="col-lg-6">
                <h2>Info</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
            </div>
        </div>

        <h2>Rooms</h2>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center">
                    <img class="card-img-top" src="img/green.jpg" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Green Room</h4>
                        <h6 class="card-subtitle mb-2 text-muted">2 Bunks</h6>
                        <p class="card-text">This is the default room for couples.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#">Hosts 4</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center">
                    <img class="card-img-top" src="img/blue.png" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Blue Room</h4>
                        <h6 class="card-subtitle mb-2 text-muted">4 Bunks</h6>
                        <p class="card-text">This is the default room for women.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#">Hosts 8</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center">
                    <img class="card-img-top" src="img/yellow.jpg" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Yellow Room</h4>
                        <h6 class="card-subtitle mb-2 text-muted">6 Bunks</h6>
                        <p class="card-text">This is the default room for men.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#">Hosts 12</a>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">COMP2000 GROUP P 2021</p>
        </div>
    </footer>








</body>
</html>
