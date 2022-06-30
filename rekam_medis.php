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
                            <h1 class="m-0"> Rekam Medis</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Form Rekam Medis</h5>
                                </div>
                                <div class="card-body">

                                    <form action="fungsi/simpanRekamMedis.php" method="POST">
                                        <input type="hidden" name="status" id="status" value="Tambah">
                                        <input type="hidden" name="idRekamMedisTxt" id="idRekamMedisTxt">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Pasien</label>
                                                <select name="pasienSelect" id="pasienSelect" class="form-control form-control-sm select2bs4" required="required">
                                                    <option value="">- Pilih Pasien -</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "SELECT * FROM tb_pasien ORDER BY id_pasien DESC");
                                                    while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <option value="<?= $data['id_pasien'] ?>"><?= $data['nomor_identitas'] . ' - ' . $data['nama_pasien'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="">Dokter</label>
                                                <select name="dokterSelect" id="dokterSelect" class="form-control form-control-sm select2bs4" required="required">
                                                    <option value="">- Pilih Dokter -</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "SELECT * FROM tb_dokter ORDER BY nama_dokter DESC");
                                                    while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <option value="<?= $data['id_dokter'] ?>"><?= $data['poli'] . ' - ' . $data['nama_dokter'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="">Tanggal Berobat</label>
                                                <input type="date" name="tanggalBerobat" id="tanggalBerobat" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">Keluhan</label>
                                                <textarea name="keluhanTxt" id="keluhanTxt" class="form-control" cols="30" rows="3"></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Hasil Diagnosa</label>
                                                <textarea name="diagnosaTxt" id="diagnosaTxt" class="form-control" cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-success" type="submit" id="tombol">Simpan</button>
                                            <button class="btn btn-sm btn-default" id="batal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Daftar Rekam Medis</h5>
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
                                    <div class="table-responsive">
                                        <table id="tableRm" class="table table-sm table-hover">
                                            <thead>
                                                <th>No</th>
                                                <th>Pasien</th>
                                                <th>Dokter</th>
                                                <th>Tanggal Berobat</th>
                                                <th>Keluhan</th>
                                                <th>Diagnosa</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT
                                                 A.id_berobat,
                                                 B.nama_pasien,
                                                 C.nama_dokter,
                                                 A.tgl_berobat,
                                                 A.keluhan_pasien,
                                                 A.hasil_diagnosa 
                                             FROM
                                                 tb_berobat A
                                                 JOIN tb_pasien B ON A.id_pasien = B.id_pasien
                                                 JOIN tb_dokter C ON A.id_dokter = C.id_dokter 
                                             ORDER BY
                                                 A.id_berobat DESC");
                                                $no = 1;
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $data['nama_pasien'] ?></td>
                                                        <td><?= $data['nama_dokter'] ?></td>
                                                        <td><?= $data['tgl_berobat'] ?></td>
                                                        <td><?= $data['keluhan_pasien'] ?></td>
                                                        <td><?= $data['hasil_diagnosa'] ?></td>
                                                        <td>
                                                            <a href="fungsi/hapusRekamMedis.php?id=<?= $data['id_berobat'] ?>" class="btn btn-sm btn-danger" title="Delete">&nbsp;<i class="fas fa-times"></i>&nbsp;</a>
                                                            <button class="btn btn-sm btn-warning" title="Edit" onclick="edit(<?= $data['id_berobat'] ?>)"> <i class="fas fa-pencil-alt"></i> </button>
                                                            <a href="resep.php?id=<?=$data['id_berobat'];?>" class="btn btn-sm btn-primary">Resep Obat</a>
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
            $("#tableRm").DataTable({
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $("#batal").click(function() {
                $("#status").val('Tambah');
                $("#idRekamMedisTxt").val('');
                $("#pasienSelect").val(''), change();
                $("#dokterSelect").val('').change();
                $("#tanggalBerobat").val('');
                $("#keluhanTxt").val('');
                $("#diagnosaTxt").val('');
            });
        });

        function edit(id) {
            $.ajax({
                "url": "fungsi/getRekamMedis.php?id=" + id,
                "method": "GET",
            }).done(function(response) {
                var object = JSON.parse(response);
                $("#status").val('Edit');
                $("#idRekamMedisTxt").val(object[0][0]);
                $("#pasienSelect").val(object[0][1]).change();
                $("#dokterSelect").val(object[0][2]).change();
                $("#tanggalBerobat").val(object[0][3]);
                $("#keluhanTxt").val(object[0][4]);
                $("#diagnosaTxt").val(object[0][5]);
            });
        }
    </script>
</body>

</html>