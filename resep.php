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
        $query = "SELECT
                    A.id_berobat,
                    B.nama_pasien,
                    C.nama_dokter
                 FROM
                    tb_berobat A
                    JOIN tb_pasien B ON A.id_pasien = B.id_pasien
                    JOIN tb_dokter C ON A.id_dokter = C.id_dokter
                 WHERE 
                    A.id_berobat = '" . $_GET['id'] . "'";
        $exec = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_array($exec)) {
            $namaDokter = $data['nama_dokter'];
            $namaPasien = $data['nama_pasien'];
        }
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Kelola Resep</h1>
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
                                    <h5 class="card-title m-0">Form Resep</h5>
                                </div>
                                <div class="card-body">

                                    <form action="fungsi/simpanResep.php" method="POST">
                                        <input type="hidden" name="status" id="status" value="Tambah">
                                        <input type="hidden" name="idResep" id="idResep">
                                        <input type="hidden" name="idBerobat" id="idBerobat" value=<?=$_GET['id']?>>

                                        <div class="form-group">
                                            <label for="">Obat</label>
                                            <select name="obatSelect" id="obatSelect" class="form-control form-control-sm select2bs4" required="required">
                                                <option value="">- Pilih Obat -</option>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT * FROM tb_obat ORDER BY nama_obat ASC");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $data['id_obat'] ?>"><?= $data['nama_obat'] . ' - ' . "Rp " . number_format($data['harga'], 0, ',', '.') . ', -' ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input type="text" class="form-control" name="jumlahTxt" id="jumlahTxt">
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-sm btn-success" type="submit" id="tombol">Simpan</button>
                                            <button class="btn btn-sm btn-default" id="batal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Resep Pasien : <b id="namaPasien"><?= $namaPasien; ?></b></h5>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($_SESSION['info'])) { ?>
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <?= $_SESSION['info'] ?>
                                        </div>
                                    <?php
                                        unset($_SESSION['info']);
                                    }
                                    ?>
                                    <p class="card-text">Resep dari : <b id="namaDokter"><?= $namaDokter; ?></b></p>
                                    <div class="table-responsive table-sm">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT
                                                                A.id_resep,
                                                                B.nama_obat,
                                                                A.jumlah,
                                                                ( B.harga * A.jumlah ) AS total 
                                                            FROM
                                                                tb_resep A
                                                                JOIN tb_obat B ON A.id_obat = B.id_obat 
                                                            WHERE
                                                                A.id_berobat = '2'";
                                                $exec = mysqli_query($conn, $query);
                                                $no = 1;
                                                $totalHarga = 0;
                                                while ($data = mysqli_fetch_array($exec)) {
                                                    $totalHarga = $totalHarga + $data['total'];
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $data['nama_obat'] ?></td>
                                                        <td><?= $data['jumlah'] ?></td>
                                                        <td><?= "Rp " . number_format($data['total'],0,',','.') . ', -' ?></td>
                                                        <td>
                                                            <a href="fungsi/hapusUser.php?id=<?= $data['id_user'] ?>" class="btn btn-sm btn-danger" title="Delete">&nbsp;<i class="fas fa-times"></i>&nbsp;</a>
                                                            <button class="btn btn-sm btn-warning" title="Edit" onclick="edit(<?= $data['id_resep'] ?>)"> <i class="fas fa-pencil-alt"></i> </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right"><i>Total Harga : </i></td>
                                                    <td><?="Rp " . number_format($totalHarga,0,',','.') . ', -'?></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
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

            $("#batal").click(function() {
                $("#status").val('Tambah');
                $("#obatSelect").val('').change();
                $("#jumlahTxt").val('');
            });
        });

        function edit(id) {
            $.ajax({
                "url": "fungsi/getResep.php?id=" + id,
                "method": "GET",
            }).done(function(response) {
                var object = JSON.parse(response);
                $("#status").val("Edit");
                $("#idResep").val(object[0][0]);
                $("#obatSelect").val(object[0][2]).change();
                $("#jumlahTxt").val(object[0][3]);
            });
        }
    </script>
</body>

</html>