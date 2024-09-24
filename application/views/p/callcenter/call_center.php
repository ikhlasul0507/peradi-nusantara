<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url('assets/p/sistem/img/logo.png');?>" type="image/x-icon" />
    <title>CS Peradi Nusantara</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/p/sistem/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/p/sistem/');?>css/sb-admin-2.min.css" rel="stylesheet">
    <style type="text/css">
        .bg-register-image {
            background: url("https://netrinoimages.s3.eu-west-2.amazonaws.com/2020/01/17/674855/284031/whatsapp_3d_icon_logo_emblem_3d_model_c4d_max_obj_fbx_ma_lwo_3ds_3dm_stl_4733133.png");
            background-position: center;
            background-size: cover;
        }
        .list-contact {
            max-height: calc(110vh - 170px);/* Maximum height is the full height of the viewport */
            overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
        }
        .rounded-circle{
            width: 50px;
            height: 50px;
        }
        
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-success"> 

    <!-- Begin Page Content -->
                <div class="container-fluid bg-success mt-1">
                    <div class="row">
                        <!-- Third Column -->
                        <div class="col-lg-4">

                            <!-- Grayscale Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <a href="<?= base_url('P/Admin/main');?>">
                                        <i class="fas fa-sign-out-alt text-danger fa-lg fa-fw mr-2"></i>
                                    </a>
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kontak
                                    </h6>
                                    <input type="search" placeholder="Cari Kontak" class="form-control col-7" name="" minlength="20">
                                </div>
                                <div class="card-body list-contact">
                                    <?php for ($i=0; $i < 20; $i++) { ?>
                                    <div class="card border-left-danger">
                                         <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle" src="<?= base_url('assets/p/sistem/img/logo.png');?>"
                                                    alt="...">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate text-primary">Agung Rilo</div>
                                                <div class="small text-truncate">Ikhlasul Amal, Online 58m Ago</div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">

                            <!-- Grayscale Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Agung Rilo
                                    </h6>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


    <script src="<?= base_url('assets/p/sistem/');?>js/validation.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/p/sistem/');?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/p/sistem/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/p/sistem/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/p/sistem/');?>js/sb-admin-2.min.js"></script>
    <?php  if($this->session->flashdata('pesan')): ?> 
        <script type="text/javascript">
            $(document).ready(function(){
              Swal.fire({
                title: "<?php echo $this->session->flashdata('pesan'); ?>",
              });
            });
          </script>
      <?php  endif; ?>
</body>

</html>