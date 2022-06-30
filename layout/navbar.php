<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">Welcome!</a>
                </li>

                <?php if ($_SESSION['level'] == "Administrator") { ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master Data</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li><a href="user.php" class="dropdown-item">Daftar User</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="dokter.php" class="dropdown-item">Dokter</a></li>
                        <li><a href="obat.php" class="dropdown-item">Obat</a></li>
                    </ul>
                </li>
                <?php } ?>
                
                <?php if ($_SESSION['level'] == "User" || $_SESSION['level'] == "Administrator") { ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pelayanan</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="pasien.php" class="dropdown-item">Pasien</a></li>
                        <!-- Level two dropdown-->
                        <li><a href="rekam_medis.php" class="dropdown-item">Rekam Medis</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item">
                <a href="gantiPassword.php" class="nav-link">Ganti Password</a>
            </li>
            <li class="nav-item">
                <a href="fungsi/logout.php" class="nav-link">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->