<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= $title; ?></title>
  <link href="<?= base_url('assets/peserta/dist/') ?>css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

  <script src="<?= base_url('assets/');?>Chart.js"></script>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/peserta/dist/') ?>js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/peserta/dist/') ?>assets/demo/chart-area-demo.js"></script>
  <script src="<?= base_url('assets/peserta/dist/') ?>assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/peserta/dist/') ?>assets/demo/datatables-demo.js"></script>
</head>
<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
    <a class="navbar-brand" href="index.html">Panel Administrator</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
      ><!-- Navbar Search-->
      <?php
      $a = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@usingDataWithAPI'")->row_array();
      $re = $a['valueParameter'];
      if($re==1){
       ?>
       <button id="btnAPIConnect" class="btn btn-light" type="button" disabled>
        <span class="text-light" role="status" aria-hidden="true"></span>
        Use API
      </button>
    <?php }else{?>
      <button id="btnAPIDisconnect" class="btn btn-light" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        No API
      </button>
    <?php } ?>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">

        <?php
        $a = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@statusVoteInPublic'")->row_array();
        $re = $a['valueParameter'];

        $avc = $this->db->query("SELECT * FROM tbl_parameter where namaParameter='@activeFromBuyingE-Voucher'")->row_array();
        $revc = $avc['valueParameter'];

        if($re==1){
         ?>
         <b>Vote <h4>Open...</h4></b>
       <?php }else{ ?>
        <b>Vote <h4>Tutup...</h4></b>
      <?php } ?>

    </div>
  </form>
  <!-- Navbar-->
  <a href=""><i class="fas fa-home"></i></a>
  <ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?= base_url('L_a/logad');?>" onclick="return confirm('Yakin Keluar ?');">Logout</a>
      </div>
    </li>
  </ul>
</nav>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
      <div class="sb-sidenav-menu text-light">
        <div class="nav">
         <div class="sb-sidenav-menu-heading">
          <div class="form-check form-check-solid">
            <?php if($re==1){ ?>
            <input class="form-check-input" id="flexCheckSolidChecked" onclick="switchVote(0)" type="checkbox" value="" checked style="width: 20px; height: 20px;">
              <span class="badge badge-success mt-2 ml-2">Vote is open</span>
            <?php }else{ ?>
               <input class="form-check-input" id="flexCheckSolidChecked" onclick="switchVote(1)" type="checkbox" value="" style="width: 20px; height: 20px;">
              <span class="badge badge-danger mt-2 ml-2">Vote is close</span>
            <?php } ?>
          </div>
           <div class="form-check form-check-solid">
            <?php if($revc==1){ ?>
            <input class="form-check-input" id="flexCheckSolidChecked" type="checkbox"  onclick="switchBuyVC(0)"  checked style="width: 20px; height: 20px;">
            <span class="badge badge-success mt-2 ml-2">Buy Voucher is open</span>
             <?php }else{ ?>
               <input class="form-check-input" id="flexCheckSolidChecked" onclick="switchBuyVC(1)" type="checkbox" value="" style="width: 20px; height: 20px;">
              <span class="badge badge-danger mt-2 ml-2">Buy Voucher is close</span>
            <?php } ?>
          </div>
        </div>
          <div class="sb-sidenav-menu-heading">Data SPK</div>
          <?php 
          $usersData = $this->db->query("SELECT * FROM tbl_menu WHERE isActive=1 AND jenisMenu=1 ORDER BY idMenu ASC" )->result_array();
          foreach ($usersData as $key) :
           ?>
           <a class="nav-link" href="<?= base_url('admin/').$key['urlMenu'];?>"
            ><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            <?= $key['namaMenu'];?></a>   

          <?php endforeach; ?> 
          <div class="sb-sidenav-menu-heading">Data Voting</div>
          <?php 
          $usersData = $this->db->query("SELECT * FROM tbl_menu WHERE isActive=1 AND jenisMenu=2 ORDER BY idMenu ASC" )->result_array();
          foreach ($usersData as $key) :
           ?>
           <a class="nav-link" href="<?= base_url('admin/').$key['urlMenu'];?>"
            ><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            <?= $key['namaMenu'];?></a>   

          <?php endforeach; ?>  
          <div class="sb-sidenav-menu-heading">Report Voting</div>

          <?php 
          $usersData = $this->db->query("SELECT * FROM tbl_menu WHERE isActive=1 AND jenisMenu=3 ORDER BY idMenu ASC" )->result_array();
          foreach ($usersData as $key) :
           ?>
           <a class="nav-link" href="<?= base_url('admin/').$key['urlMenu'];?>"
            ><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            <?= $key['namaMenu'];?></a>   

          <?php endforeach; ?>

          <?php
          $em = $this->session->userdata('email');
          if($em=="amal@gmail.com"){
            ?>
            <div class="sb-sidenav-menu-heading">Setting</div>
            <a class="nav-link" href="<?= base_url('Admin/parameter');?>"
              ><div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Parameter</a>
            <a class="nav-link" href="<?= base_url('Admin/menuKontrol');?>"
              ><div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Menu Kontrol</a>
            <a class="nav-link" href="<?= base_url('Admin/duser');?>"
              ><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            Data User</a>
            <a class="nav-link" href="<?= base_url('Admin/generateJson');?>"
              ><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            Generate JSON</a>
            <a class="nav-link" href="<?= base_url('Admin/executeQuery');?>"
              ><div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Execute Query</a>
            <a class="nav-link" href="<?= base_url('Admin/backupDatabase');?>"
              ><div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
            Backup Database</a>

          <?php } ?>

        </div>

      </nav>
    </div>

    <style type="text/css">
      th{
        background-color: black;
        color: white;
      }
      button {
        background-color: black;
        color: white
      }
      button:hover{
        background-color: white;
        color: black
      }
      #btnAPIConnect {
        display: inline;
      }
      #btnAPIDisconnect {
       display: inline;
     }
     @media (min-width: 400px) {
      .container {
        max-width: 540px;
      }
      #btnAPIConnect {
        font-size: 10px;
      }
      #btnAPIDisconnect {
        font-size: 10px;
      }
      .spinner-border{
        display: none;
      }
    }
                    /*@media (min-width: 768px) {
                      .container {
                        max-width: 720px;
                      }
                      #btnAPIConnect {
                        font-size: 10px;
                      }
                      #btnAPIDisconnect {
                        font-size: 10px;
                      }
                      .spinner-border{
                        display: none;
                      }
                    }
                    @media (min-width: 992px) {
                      .container {
                        max-width: 960px;
                      }
                      #btnAPIConnect {
                        font-size: 10px;
                      }
                      #btnAPIDisconnect {
                        font-size: 10px;
                      }
                      .spinner-border{
                        display: none;
                      }
                    }
                    @media (min-width: 1200px) {
                      .container {
                        max-width: 1140px;
                      }
                     #btnAPIConnect {
                        font-size: 10px;
                      }
                      #btnAPIDisconnect {
                        font-size: 10px;
                      }
                      .spinner-border{
                        display: none;
                        }*/
                      }
                    </style>
                    <script type="text/javascript">
                  var path = window.location.href; 


                  function switchVote(val){
                    if(val == 0){
                      updateStatusVote(2, "@statusVoteInPublic", 0)
                      location.reload();
                    }else{
                      updateStatusVote(2, "@statusVoteInPublic", 1)
                      location.reload();
                    }
                  }

                   function switchBuyVC(val){
                    if(val == 0){
                      updateStatusVote(10, "@activeFromBuyingE-Voucher", 0)
                      location.reload();
                    }else{
                      updateStatusVote(10, "@activeFromBuyingE-Voucher", 1)
                      location.reload();
                    }
                  }

                  function updateStatusVote(idParameter, namaParameter, status){
                      $.ajax({
                        type: "GET", 
                        url: "<?php echo base_url('Admin/updateStatusVote')?>",
                        cache: false,
                        data:  {
                          status :status,
                          idParameter : idParameter,
                          namaParameter : namaParameter,
                        },
                        dataType: "JSON",
                        success: function(data){
                          location.reload();
                        }             
                      });
                    }

                  // because the 'href' property of the DOM element is the absolute path
                  $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
                    if (this.href === path) {
                      $(this).addClass("active");

                    }
                  });
                 // Toggle the side navigation
                 $("#sidebarToggle").on("click", function(e) {
                  e.preventDefault();
                  $("body").toggleClass("sb-sidenav-toggled");

                });
              </script>