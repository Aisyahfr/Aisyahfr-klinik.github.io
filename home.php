<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="bootstrap/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="bootstrap/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php 
            require 'konfigurasi/ceksession.php';
            require 'layout/navbar.php'; 
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h3 class="">Selamat Datang!</h3>
                                    <p class="card-text">
                                        Sistem Informasi Manajemen Klinik ini memiliki fungsi untuk mengelola data dokter, data obat, pendaftaran pasien, dan berobat. 
                                        Aplikasi ini dibuat untuk memenuhi syarat tugas perkuliahan
                                    </p>
                                </div>
                            </div><!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Created By Aisyah
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="#">Klinik</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="bootstrap/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="bootstrap/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="bootstrap/dist/js/adminlte.min.js"></script>
</body>

</html>