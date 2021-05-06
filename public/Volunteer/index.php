<!--Large Banner at the top of the page-->
<div class="jumbotron text-center" style="margin-bottom:-30px; background-color: white">
    <div class="container">
        <h1 class="display-4">TALYLLYN RAILWAY</h1>
        <h1 class="lead">Welcome to the Home Page</h1>
    </div>
</div>




<?php
include_once '../Headers/header.php';
?>




<br>
    <div class="container">

        <!-- Intro Content -->
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid rounded mb-4 mt-5" src="../../assets/img/llechfantrain.jpg" alt="">
            </div>
            <div class="col-lg-6">
                <h2>Info</h2>
                <p>The Talyllyn Railway is the first preserved railway in the World, known affectionately as ‘The Railway with a Heart of Gold’.  It was over 150 years ago, in 1865, that the line opened and in 1951 the Preservation Society was born to take over the Railway after the death of the owner Sir Haydn Jones.  The heritage steam engines transport passengers from Tywyn, the coastal town on the edge of the Snowdonia National Park, to Nant Gwernol buried deep in the mountains above Abergynolwyn.</p>
                <p>The journey itself crosses more than seven miles of spectacular scenery within sight of one of Britain’s highest mountains, Cadair Idris.  The journey takes 55 minutes up the line from Tywyn through the ancient woodlands and meadows of the Fathew Valley.  En route keep your eyes peeled for Red Kites, Cormorants, Barn Owl, Redstart, Peregrine Falcons, Wheatear, Linnet and Little Owl.  The cosy covered and open carriages provide the best of comfort and views as you travel up the line.</p>
            </div>
        </div>



        <h2>Rooms</h2>



        <!--Display image of green room with description-->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center">
                    <img class="card-img-top" src="../../assets/img/green.jpg" alt="Green Room Preview">
                    <div class="card-body">
                        <h4 class="card-title">Green Room</h4>
                        <h6 class="card-subtitle mb-2 text-muted">2 Bunks</h6>
                        <p class="card-text">This is the default room for couples.</p>
                    </div>
                    <div class="card-footer">
                        <a href="../Volunteer/createBooking.php">Hosts up to 4</a>
                    </div>
                </div>
            </div>



            <!--Display image of blue room with description-->
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center">
                    <img class="card-img-top" src="../../assets/img/blue.jpg" alt="Blue Room Preview">
                    <div class="card-body">
                        <h4 class="card-title">Blue Room</h4>
                        <h6 class="card-subtitle mb-2 text-muted">4 Bunks</h6>
                        <p class="card-text">This is the default room for women.</p>
                    </div>
                    <div class="card-footer">
                        <a href="../Volunteer/createBooking.php">Hosts up to 8</a>
                    </div>
                </div>
            </div>



            <!--Display image of yellow room with description-->
            <div class="col-lg-4 mb-4">
                <div class="card h-100 text-center">
                    <img class="card-img-top" src="../../assets/img/yellow.jpg" alt="Yellow Room Preview">
                    <div class="card-body">
                        <h4 class="card-title">Yellow Room</h4>
                        <h6 class="card-subtitle mb-2 text-muted">6 Bunks</h6>
                        <p class="card-text">This is the default room for men.</p>
                    </div>
                    <div class="card-footer">
                        <a href="../Volunteer/createBooking.php">Hosts up to 12</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once '../Headers/footer.php';
?>