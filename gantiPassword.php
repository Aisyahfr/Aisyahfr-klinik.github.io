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
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="bootstrap/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bootstrap/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="bootstrap/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bootstrap/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="bootstrap/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="bootstrap/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="bootstrap/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php
        require 'konfigurasi/ceksession.php';
        require 'konfigurasi/koneksi.php';
        require 'layout/navbar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Ganti Password</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Form Ganti Password</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($_SESSION['info'])) { ?>
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <?= $_SESSION['info'] ?>
                                        </div>
                                    <?php
                                        if ($_SESSION['info'] == "Password berhasil diubah") {
                                            session_destroy();
                                        }

                                        unset($_SESSION['info']);
                                    }
                                    ?>
                                    <form action="fungsi/gantiPassword.php" method="POST">
                                        <input type="hidden" name="status" id="status" value="Tambah">
                                        <input type="hidden" name="idUserTxt" id="idUserTxt">

                                        <div class="form-group">
                                            <label for="">Password Lama</label>
                                            <input type="password" class="form-control form-control-sm" name="oldPassword" id="oldPassword" required="required" value="">
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label for="">Password Baru</label>
                                            <input type="password" class="form-control form-control-sm" name="newPassword" id="newPassword" required="required" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Konfirmasi Password</label>
                                            <input type="password" class="form-control form-control-sm" name="confirm" id="confirm" required="required" value="">
                                            <small id="errorMsg" class="text-danger" style="display: none;">Konfirmasi password tidak sesuai</small>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-sm btn-success" type="submit" id="tombol">Simpan</button>
                                            <button class="btn btn-sm btn-default" id="batal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    <!-- Select2 -->
    <script src="bootstrap/plugins/select2/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="bootstrap/plugins/moment/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="bootstrap/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="bootstrap/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="bootstrap/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="bootstrap/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="bootstrap/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="bootstrap/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="bootstrap/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="bootstrap/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="bootstrap/dist/js/adminlte.min.js"></script>
    <script>
        $(function() {
            $("#batal").click(function() {
                $("#status").val('Tambah');
                $("#idUserTxt").val('');
                $("#usernameTxt").val('');
                $("#levelSelect").val('').change();
                $("#tombol").html("Tambah User");
            });

            $("#newPassword").keyup(function() {
                var newP = $("#newPassword").val();
                var conf = $("#confirm").val();
                if (newP != conf) {
                    $("#errorMsg").fadeIn(1);
                    $("#tombol").prop("disabled", "disabled");
                } else {
                    $("#errorMsg").fadeOut(1);
                    $("#tombol").removeAttr("disabled");
                }
            });

            $("#confirm").keyup(function() {
                var newP = $("#newPassword").val();
                var conf = $("#confirm").val();
                if (newP != conf) {
                    $("#errorMsg").fadeIn(1);
                    $("#tombol").prop("disabled", "disabled");
                } else {
                    $("#errorMsg").fadeOut(1);
                    $("#tombol").removeAttr("disabled");
                }
            });
        });
    </script>
</body>

</html>