<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url('assets/p/sistem/img/logo.png');?>" type="image/x-icon" />
    <title>Peradi Nusantara</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/p/sistem/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/p/sistem/');?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/p/sistem/');?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
    <style type="text/css">
        
        .container-fluid {
            max-height: calc(100vh - 150px);/* Maximum height is the full height of the viewport */
            overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
        }

        #accordionSidebar {
            max-height: calc(100vh - 150px);/* Maximum height is the full height of the viewport */
            overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
        }
        .collapse .show{
            z-index: 10000;
            width: 100vh;
        }
        .sidebar {
            width: 8.5rem;
            min-height: 100vh;
        }

        .sidebar .nav-item .collapse {
            position: relative;
            left: 0;
            z-index: 1000 !important;
            top: 2px;
            width: 3.5rem;
        }
        /*#collapsePages{
            z-index: 100000 !important;
        }
        .collapse .show{
            position: relative;
            z-index: 1000 !important;
        }*/
        @media (min-width: 768px) {
            .sidebar {
                width: 17rem!important;
            }
            .sidebar.toggled {
                overflow: visible;
                width: 8.5rem !important;
            }
        }

        #loading {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            /*background: center no-repeat #fff;*/
            background-color: silver;
            opacity: 0.5;
            /*background: center no-repeat #fff;*/
        }
         
        /*-- css spin --*/
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
         
        /*-- css loader --*/
        .no-js #loader { display: none; }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
         
        .loader {
            border: 10px solid #f3f3f3;
            border-radius: 50%;
            border-top: 10px solid #3498db;
            border-bottom: 10px solid #FFC107;
            width: 150px;
            height: 150px;
            left: 43.5%;
            top: 20%;
            -webkit-animation: spin 2s linear infinite;
            position: fixed;
            animation: spin 2s linear infinite;
        }
         
        .textLoader{
            position: fixed;
            top: 56%;
            left: 40.6%;
            color: black;
        }
           
        /*-- responsive --*/
        @media screen and (max-width: 1034px){
            .textLoader{
                left: 46.2%;
            }
        }
     
        @media screen and (max-width: 824px){
            .textLoader {
                left: 47.2%;
            }
        }
     
        @media screen and (max-width: 732px){
            .textLoader {
                left: 48.2%;
            }
        }
     
        @media screen and (max-width: 500px){
            .loader{
                left: 36.5%;;
            }
            .textLoader {
                left: 40.5%;
            }
        }
     
        @media screen and (max-height: 432px){
            .textLoader {
                top: 65%;
            }
        }
     
        @media screen and (max-height: 350px){
            .textLoader {
                top: 75%;
            }
        }
     
        @media screen and (max-height: 312px){
            .textLoader {
                display: none;
            }
        }
        .bg-default{
            background: url("<?= base_url('assets/p/img/bg-default.jpg');?>");
            background-position: center;
            background-size: cover;
        }
        .dataTable{
            color: black;
        }
        .dataTable thead th{
            background-color: silver;
        }
    </style>
</head>

<body id="page-top"  style="overflow-y: hidden;">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('P/Admin');?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Peradi<sup>N</sup></div>
            </a>

            <?php 

                $kelasBelajar = "";
                $MyClass = "";
                $OrderanClass = "";
                $daftarorderan = "";
                $DoneClass = "";
                $Sertifikat = "";
                $DoneSertifikat = "";
                $master_product = "";
                $parameter = "";
                $report_peserta = "";
                $report_kta_peserta = "";
                $master = "";
                $process = "";

                $segment2 = $this->uri->segment(3);
                if($segment2 == "report_peserta"){
                     $report_peserta = "active";
                }else if($segment2 == "report_kta_peserta"){
                     $report_kta_peserta = "active";
                }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <li class="nav-item <?=$report_peserta;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/report_peserta');?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Detail  Peserta</span></a>
            </li>
            <li class="nav-item <?=$report_kta_peserta;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/report_kta_peserta');?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Detail  KTA Peserta</span></a>
            </li>
            <!-- <li class="nav-item <?=$report_pembayaran;?>">
                <a class="nav-link" href="<?= base_url('P/Payment/report_pembayaran');?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Detail  Pembayaran</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-default">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            
                            <!-- Dropdown - Messages -->
                        
                        </li>

                         <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown mx-1">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" data-target="#logoutModal">
                                <span class="button button-danger text-gray-600">Keluar</span>
                            </a>
                  
                        </li>
                 
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart fa-fw text-gray-600"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?= count($list_cart);?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Keranjang Belanja
                                </h6>
                                <?php 
                                $list_kelas = "";
                                foreach ($list_cart as $lc) { 
                                $list_kelas .= $lc['id_master_kelas'] ."~";
                                ?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <button onclick="confirmDeleteData('<?= base_url('P/Admin/delete_cart_product/').$lc['id_master_kelas'];?>')" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?= $lc['nama_kelas'];?></div>
                                    </div>
                                </a>
                                <?php } 
                                if(count($list_cart) > 0){
                                ?>
                                
                                <a class="dropdown-item text-center btn btn-danger" data-toggle="modal" data-target="#modalCart">Lanjutkan Pembelian</a>
                                <?php } ?>
                            </div>
                        </li>
                        <?php if($this->session->userdata('user_level') <= 3){ ?>
                        <li class="nav-item dropdown mx-1">
                            <a class="nav-link " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Menu Utama" href="<?= base_url('P/Admin/main');?>">
                                <i class="fa fa-th-large text-gray-600"></i>
                            </a>
                  
                        </li>
                        <?php } ?>
                    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form class="user" action="<?= base_url('P/Admin/process_order_product_list')?>" method="post">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="hidden" name="list_kelas" value="<?= $list_kelas; ?>">
                                        <select class="form-control" name="metode_bayar" required>
                                            <option value="" disabled selected class="placeholder">--Pilih Metode Pembayaran--</option>
                                            <option value="Lunas">Lunas</option>
                                            <option value="Bertahap">Bertahap</option>
                                            <option value="Cicilan">Cicilan</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Beli Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$this->session->userdata('nama_lengkap');?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('assets/p/sistem/img/logo.png');?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('P/Admin/show_profile');?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
