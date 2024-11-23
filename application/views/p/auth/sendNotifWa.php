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
        .containerLoading {
          height: 1vh;
          width: 100vw;
          font-family: Helvetica;
        }

        .loader {
          height: 10px;
          width: 250px;
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          margin: auto;
        }

        .loader--dot {
          animation-name: loader;
          animation-timing-function: ease-in-out;
          animation-duration: 3s;
          animation-iteration-count: infinite;
          height: 20px;
          width: 20px;
          border-radius: 100%;
          background-color: black;
          position: absolute;
          border: 2px solid white;
        }

        .loader--dot:first-child {
          background-color: #8cc759;
          animation-delay: 0.5s;
        }

        .loader--dot:nth-child(2) {
          background-color: #8c6daf;
          animation-delay: 0.4s;
        }

        .loader--dot:nth-child(3) {
          background-color: #ef5d74;
          animation-delay: 0.3s;
        }

        .loader--dot:nth-child(4) {
          background-color: #f9a74b;
          animation-delay: 0.2s;
        }

        .loader--dot:nth-child(5) {
          background-color: #60beeb;
          animation-delay: 0.1s;
        }

        .loader--dot:nth-child(6) {
          background-color: #fbef5a;
          animation-delay: 0s;
        }

        .loader--text {
          position: absolute;
          top: 200%;
          left: 0;
          right: 0;
          width: 4rem;
          margin: auto;
        }

        .loader--text:after {
          content: "Loading";
          font-weight: bold;
          animation-name: loading-text;
          animation-duration: 3s;
          animation-iteration-count: infinite;
        }

        @keyframes loader {
          15% {
            transform: translateX(0);
          }
          45% {
            transform: translateX(230px);
          }
          65% {
            transform: translateX(230px);
          }
          95% {
            transform: translateX(0);
          }
        }

        @keyframes loading-text {
          0% {
            content: "Loading";
          }
          25% {
            content: "Loading.";
          }
          50% {
            content: "Loading..";
          }
          75% {
            content: "Loading...";
          }
        }
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-gradient-success">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row" style="height: 576px">
                    <div class="col-lg-7 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-5">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">Mulai Obrolan</h1>
                            </div>
                            <div class='containerLoading'>
                              <div class='loader'>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--text'></div>
                              </div>
                            </div>
                            <form class="user" name="chatForm" id="chatForm" action="<?= base_url('P/Callcenter/process_call_wa')?>" method="post">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                 <input type="hidden" name="initial" value="<?= $this->uri->segment(2); ?>">
                                <div class="form-group">
                                     <input 
                                            type="text" 
                                            class="form-control" 
                                            required 
                                            name="namalengkap" 
                                            id="namalengkap" 
                                            placeholder="Nama lengkap">
                                </div>
                                <div class="form-group">
                                   <input type="tel" class="form-control"
                                            required name="handphone" 
                                            pattern="0[0-9]{9,}" 
                                            id="handphone" 
                                            placeholder="No Whatsapp Customer" 
                                            onkeypress="return isNumberKey(event,'hp')"
                                            oninput="validatePhoneNumber(this)">
                                </div>
                       
                                <button type="submit" class="btn btn-success" id="startChatButton" onclick="disableButton(this)">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    Mulai Chat
                                </button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
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
    <script type="text/javascript">
        function disableButton(button) {
            if(document.getElementById("namalengkap").value != "" && 
                document.getElementById("handphone").value != ""){
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sedang memulai...';
                document.chatForm.submit();
            }else{
                Swal.fire({
                    title: "Lengkapi Nama dan Handphone !",
                  });
            }
        }
    </script>
</body>

</html>