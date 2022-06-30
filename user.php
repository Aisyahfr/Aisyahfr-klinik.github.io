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
                            <h1 class="m-0"> Kelola User</h1>
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
                                    <h5 class="card-title m-0">Form User</h5>
                                </div>
                                <div class="card-body">

                                    <form action="fungsi/simpanUser.php" method="POST">
                                        <input type="hidden" name="status" id="status" value="Tambah">
                                        <input type="hidden" name="idUserTxt" id="idUserTxt">
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" class="form-control form-control-sm" name="usernameTxt" id="usernameTxt" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Level</label>
                                            <select name="levelSelect" id="levelSelect" class="form-control form-control-sm select2bs4" required="required">
                                                <option value="">- Pilih Level -</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="User">User</option>
                                            </select>
                                        </div>

                                        <p class="card-text">Default password awal untuk user adalah <b class="text-danger">1234</b>. User disarankan mengubah password</p>

                                        <div class="form-group">
                                            <button class="btn btn-sm btn-success" type="submit" id="tombol">Tambah User</button>
                                            <button class="btn btn-sm btn-default" id="batal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Daftar User</h5>
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
                                        <table id="tableUser" class="table table-hover">
                                            <thead>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Level</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($conn, "SELECT id_user, username, level FROM tb_user ORDER BY username ASC");
                                                $no = 1;
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $data['username'] ?></td>
                                                        <td><?= $data['level'] ?></td>
                                                        <td>
                                                            <a href="fungsi/hapusUser.php?id=<?=$data['id_user']?>" class="btn btn-sm btn-danger" title="Delete">&nbsp;<i class="fas fa-times"></i>&nbsp;</a>
                                                            <button class="btn btn-sm btn-warning" title="Edit" onclick="edit(<?=$data['id_user'] ?>, '<?=$data['username']?>', '<?=$data['level']?>')"> <i class="fas fa-pencil-alt"></i> </button>
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
            $('#tableUser').DataTable({
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $("#batal").click(function() {
                $("#status").val('Tambah');
                $("#idUserTxt").val('');
                $("#usernameTxt").val('');
                $("#levelSelect").val('').change();
                $("#tombol").html("Tambah User");
            });
        });

        function edit($id, $username, $level) {
            $("#status").val("Edit");
            $("#idUserTxt").val($id);
            $("#usernameTxt").val($username)
            $("#levelSelect").val($level).change();
            $("#tombol").html("Edit User");
        }
    </script>
</body>

</html>