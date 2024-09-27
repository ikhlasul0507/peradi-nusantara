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
        .bg-default{
            background: url("<?= base_url('assets/p/img/bg-default.jpg');?>");
            background-position: center;
            background-size: cover;
        }
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-default">

    <div class="container ">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 bg-primary">
                <div class="row">
                    <!-- <div class="col-lg-6 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-12 ">
                        <div class="p-4 mt-3 ">
                            <div class="text-center">
                                <h4 class="h4 text-light">Management System</h4>
                                <h6 class="h6 text-light">Peradi Nusantara</h6>
                            </div>
                            <hr style="height: 1px;color: white;background-color: white;">
                            <div class="form-group text-center">
                                <a href="<?= base_url('P/Admin');?>" class="btn btn-danger btn-lg mt-3 ml-3">
                                    <i class="fa fa-home" aria-hidden="true" style="font-size:48px;"></i>
                                    <br>
                                    <small>System Info</small>
                                </a>
                                <a href="<?= base_url('P/Admin/call_center');?>" class="btn btn-danger btn-lg mt-3 ml-3">
                                    <i class="fab fa-whatsapp" aria-hidden="true" style="font-size:48px;"></i>
                                    <br>
                                    <small>Call Center</small>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <div class="status-indicator bg-success"></div>
                        <span>Check Connection : GOOD <i class="fas fa-check text-success"></i></span>
                    </div>
                </div>
            </footer>
            </div>
        </div>

    </div>


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