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
                            <h1 class="m-0"> Kelola Dokter</h1>
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
                                    <h5 class="card-title m-0">Form Dokter</h5>
                                </div>
                                <div class="card-body">

                                    <form action="fungsi/simpanDokter.php" method="POST">
                                        <input type="hidden" name="status" id="status" value="Tambah">
                                        <input type="hidden" name="idDokterTxt" id="idDokterTxt">
                                        <div class="form-group">
                                            <label for="">Nama Dokter</label>
                                            <input type="text" class="form-control form-control-sm" name="namaDokterTxt" id="namaDokterTxt" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Poli</label>
                                            <input type="text" class="form-control form-control-sm" name="poliTxt" id="poliTxt" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Telepon</label>
                                            <input type="text" class="form-control form-control-sm" name="teleponTxt" id="teleponTxt" required="required">
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-sm btn-success" type="submit" id="tombol">Tambah Dokter</button>
                                            <button class="btn btn-sm btn-default" id="batal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Daftar Dokter</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($_SESSION['info'])) { ?>
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <?=$_SESSION['info']?>
                                        </div>
                                    <?php 
                                            unset($_SESSION['info']);
                                        } 
                                    ?>
                                    <div class="table-responsive table-sm">
                                        <table id="tableDokter" class="table table-hover">
                                            <thead>
                                                <th>No</th>
                                                <th>Nama Dokter</th>
                                                <th>Poli</th>
                                                <th>Telepon</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * FROM tb_dokter ORDER BY nama_dokter ASC");
                                                $no = 1;
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $data['nama_dokter'] ?></td>
                                                        <td><?= $data['poli'] ?></td>
                                                        <td><?= $data['telepon'] ?></td>
                                                        <td>
                                                            <a href="fungsi/hapusDokter.php?id=<?=$data['id_dokter']?>" class="btn btn-sm btn-danger" title="Delete">&nbsp;<i class="fas fa-times"></i>&nbsp;</a>
                                                            <button class="btn btn-sm btn-warning" title="Edit" onclick="edit(<?=$data['id_dokter'] ?>)"> <i class="fas fa-pencil-alt"></i> </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            //Initialize datatable
            $('#tableDokter').DataTable({
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $("#batal").click(function() {
                $("#status").val('Tambah');
                $("#idDokterTxt").val('');
                $("#namaDokterTxt").val('');
                $("#poliTxt").val('');
                $("#teleponTxt").val('');
                $("#tombol").html("Tambah Dokter");
            });
        });

        function edit(id) {
            $.ajax({
                "url": "fungsi/getDokter.php?id=" + id,
                "method": "GET",
            }).done(function(response) {
                var object = JSON.parse(response);
                $("#status").val('Edit');
                $("#idDokterTxt").val(object[0][0]);
                $("#namaDokterTxt").val(object[0][1]);
                $("#poliTxt").val(object[0][2]);
                $("#teleponTxt").val(object[0][3]);
                $("#tombol").html("Edit Dokter");
            });
        }
    </script>
</body>

</html>