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
    <style type="text/css">
        .bg-register-image {
            background: url("<?= base_url('assets/p/sistem/img/gambarlogin.png');?>");
            background-position: center;
            background-size: cover;
        }
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Formulir Pendaftaran || <a href="<?= base_url('P/Auth/login');?>">Masuk Sistem</a></h1>
                            </div>
                            <form class="user" action="<?= base_url('P/Auth/process_register')?>" method="post" enctype="multipart/form-data">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control" required name="namalengkap"
                                            placeholder="Nama lengkap" onkeypress="return isAlphaKey(event,'nama')">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" min="0" required name="nik"
                                            placeholder="NIK" maxlength="16" pattern="\d{16}" onkeypress="return isNumberKey(event,'nik')">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input type="email" class="form-control" required name="email"
                                        placeholder="Email Aktif" onkeypress="return validateEmailKeypress(event)">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Unggah Foto KTP</label>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="file" required name="file_ktp"
                                        placeholder="Upload KTP"  accept="image/*,application/pdf" onchange="validateImageFile(event)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control"
                                            required name="handphone" pattern="0[0-9]{9,}" placeholder="Handpone Aktif" onkeypress="return isNumberKey(event,'hp')">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control"
                                            required name="usia" placeholder="Usia" onkeypress="return isNumberKey(event,'usia')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" required name="asalkampus"
                                        placeholder="Asal Kampus" onkeypress="return isAlphaKey(event,'kampus')">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control" required name="reference"
                                        placeholder="Referensi (Iklan, IG, FB)" onkeypress="return isAlphaKey(event,'ref')">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" required name="pic">
                                            <option value="" disabled selected>--Pilih PIC--</option>
                                            <?php foreach ($list_pic as $pic) { ?>
                                                <option value="<?=$pic;?>"><?=$pic;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" required name="is_new_user">
                                        <option value="" disabled selected>--Status Peserta--</option>
                                        <option value="Y">Peserta Baru</option>
                                        <option value="N">Pindahan</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" required name="semester">
                                            <option value="" disabled selected>--Status Kuliah--</option>
                                            <option value="1">Sudah Lulus</option>
                                            <option value="0">Belum Lulus</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" required name="latar_belakang">
                                             <option value="" disabled selected>--Pilih latar belakang--</option>
                                            <option value="1">Hukum</option>
                                            <option value="0">Non Hukum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control"
                                            required name="password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('P/Auth/login');?>">Sudah punya akun ? Masuk!</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="https://peradinusantara.org/">Halaman Utama</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- validation -->
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