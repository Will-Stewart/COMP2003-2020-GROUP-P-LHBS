<div class="shadow">
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #BF0A30;">
        <div class="navbar-collapse collapse w-150 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="../../assets/img/talyllyn-logo.png" width="228" height="66" alt="logo">
                </li>
            </ul>

        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="../Volunteer/index.php">Home</a>
            </li>

            <li class="nav-item" style="align-items: center">
                <a class="nav-link" href="../Admin/adminPortal.php">Admin Portal</a>
            </li>

            <li class="nav-item" style="align-items: center">
                <a class="nav-link" href="../Volunteer/support.php">Support</a>
            </li>
        </ul>
    </div>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item" style="align-items: center">
                <a class="nav-link" href="../Admin/adminProfile.php"><i class="fas fa-user-circle"></i> Profile: <?php echo $_SESSION['nameAdmin']?></a>
            </li>
            <li class="nav-item" style="align-items: center">
                <a class="nav-link" href="../Volunteer/logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </li>
        </ul>

</div>
