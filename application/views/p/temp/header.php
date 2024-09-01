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
</head>

<body id="page-top">

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
                $master_product = "";
                $parameter = "";
                $report_peserta = "";
                $master = "";


                $segment2 = $this->uri->segment(3);
                if($segment2 == ""){
                    $kelasBelajar = 'active';
                }else if($segment2 == "MyClass"){
                     $MyClass = "active";
                }else if($segment2 == "OrderanClass"){
                     $OrderanClass = "active";
                }else if($segment2 == "daftarorderan"){
                     $daftarorderan = "active";
                }else if($segment2 == "DoneClass"){
                     $DoneClass = "active";
                }else if($segment2 == "Sertifikat"){
                     $Sertifikat = "active";
                }else if($segment2 == "report_peserta"){
                     $report_peserta = "active";
                }else if($segment2 == "master_product"){
                     $master = "active";
                }else if($segment2 == "master_user_peserta"){
                     $master = "active";
                }else if($segment2 == "master_user_admin"){
                     $master = "active";
                }else if($segment2 == "master_user_owner"){
                     $master = "active";
                }else if($segment2 == "master_user_developer"){
                     $master = "active";
                }else if($segment2 == "parameter"){
                     $master = "active";
                }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?=$kelasBelajar;?>">
                <a class="nav-link" href="<?= base_url('P/Admin');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Kelas Belajar</span></a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?=$MyClass;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/MyClass');?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Kelas Ku</span></a>
            </li>
            <!-- Nav Item - Dashboard -->
            <?php if($this->session->userdata('user_level') < 4){ ?>
            <li class="nav-item <?=$OrderanClass;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/OrderanClass');?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Orderan Kelas</span></a>
            </li>
            <li class="nav-item <?=$daftarorderan;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/daftarorderan');?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Belum Lunas</span></a>
            </li>
            <li class="nav-item <?=$DoneClass;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/DoneClass');?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Lunas</span></a>
            </li>
            <?php if($this->session->userdata('user_level') <= 2){ ?>
            <li class="nav-item <?=$Sertifikat;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/Sertifikat');?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Approve Sertifikat</span></a>
            </li>
             <?php }?>
            <!-- Divider -->
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?=$master;?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('P/Admin/master_product');?>">Data Pelatihan</a>
                        <a class="collapse-item" href="<?= base_url('P/Admin/master_user_peserta/4');?>">Data Peserta</a>
                         <?php if($this->session->userdata('user_level') < 3){ ?>
                            <a class="collapse-item" href="<?= base_url('P/Admin/master_user_admin/3');?>">Data Admin</a>
                            <?php if($this->session->userdata('user_level') <= 2){ ?>
                            <a class="collapse-item" href="<?= base_url('P/Admin/master_user_owner/2');?>">Data Owner</a>
                            <?php if($this->session->userdata('user_level') <= 1){ ?>
                            <a class="collapse-item" href="<?= base_url('P/Admin/master_user_developer/1');?>">Data Developer</a>
                            <a class="collapse-item" href="<?= base_url('P/Admin/parameter');?>">Parameter</a>
                            <a class="collapse-item" target="blank"> href="<?= base_url('P/Migrate');?>">Restructure Database</a>
                        <?php }}} ?>
                    </div>
                </div>
            </li>
            <li class="nav-item <?=$report_peserta;?>">
                <a class="nav-link" href="<?= base_url('P/Admin/report_peserta');?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Detail  Peserta</span></a>
            </li>
            <?php } ?>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

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
                                <span class="button button-danger text-gray-600">Keluar Sistem</span>
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

                    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form class="user" action="<?= base_url('P/Admin/process_order_product_list')?>" method="post">
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
