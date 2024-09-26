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
            max-height: calc(110vh - 180px);/* Maximum height is the full height of the viewport */
            overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
        }

        #floatingTextarea {
            height: calc(90vh - 180px);/* Maximum height is the full height of the viewport */
            overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
        }
        .rounded-circle{
            width: 50px;
            height: 50px;
        }
        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden; /* Prevent horizontal overflow on the whole page */
        }
        @media (max-width: 1366px) {
            .list-contact {
                max-height: calc(110vh - 150px); /* Adjust for mobile devices */
            }
        }
        .tab-area{
            display: inline;
        }
        @media (max-width: 896px) {
            .tab-area{
                display: none;
            }
            .list-contact {
                max-height: calc(110vh - 180px); /* Adjust for mobile devices */
            }
        }
        .no-arrow{
            margin-top: 10px;
        }
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body> 
    <div class="">
        <div class="row">
            <!-- Third Column -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <a href="<?= base_url('P/Admin/main');?>">
                            <i class="fas fa-sign-out-alt text-danger fa-lg fa-fw mr-2"></i>
                        </a>
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Kontak
                        </h6>
                        <input type="text" placeholder="Cari Kontak" id="searchInput" class="form-control col-6" name="" minlength="20">
                        <a target="_blank" href="<?= base_url('cs');?>"><i class="fas fa-plus text-primary fa-lg"></i></a>
                    </div>
                    <div class="card-body list-contact" id="userData">
                        <div class="card border-left-danger">
                             <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?= base_url('assets/p/sistem/img/logo.png');?>"
                                        alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate text-primary">Contoh Name</div>
                                    <div class="small text-truncate">Contoh, Online 5m Ago</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 tab-area">

                <!-- Grayscale Utilities -->
                <div class="card shadow mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between" id="detailUser">
                        <input type="hidden" id="id_history_call_center">
                        <select class="form-control col-3 statusWA text-light" onclick="" id="myStatusWa">
                            <option class="bg-danger text-light" value="N">New Request</option>
                            <option class="bg-primary text-light" value="P">Process Request</option>
                            <option class="bg-dark text-light" value="H">Hold Request</option>
                            <option class="bg-warning text-light" value="F">Follow Up</option>
                            <option class="bg-success text-light" value="D">Done Payment</option>
                        </select>
                        <h5 class="m-0 font-weight-bold text-primary" id="nameContact">
                            <!-- Agung Rilo -->
                        </h5>
                        <a href="#" class="btn btn-success btn-circle btn-lg" id="btnSendWA">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="form-floating">
                          <label for="floatingTextarea" id="lastNotes">
                          <!-- Catatan Terakhir : 2024-09-21 12:13:45 -->
                          </label>
                          <textarea class="form-control" placeholder="..." id="floatingTextarea"></textarea>
                        </div>
                        <button class="btn btn-primary mt-3" id="btnPerbaharui">Perbaharui Catatan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Logout Modal-->
    <div class="modal fade show" id="logoutModal" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            </div>
        </div>
    </div>
    
</body>
<script src="<?= base_url('assets/p/sistem/');?>js/validation.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/p/sistem/');?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/p/sistem/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/p/sistem/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/p/sistem/');?>js/sb-admin-2.min.js"></script>
<script>

    $('#btnPerbaharui').hide();
    $('#btnSendWA').hide();
    $('#myStatusWa').hide();
    
    localStorage.setItem('search', '');
    fetchData();
    // setInterval(fetchData, 5000); 
    function fetchData(value = "") {
        value = localStorage.getItem('search');
        $.ajax({
            url: "<?php echo base_url('P/Admin/get_data_call_center'); ?>", // AJAX URL to the controller function
            type: "GET",
            data: { query: value },
            dataType: "json", // Expect JSON data
            success: function(data) {
                // Empty previous data
                $('#userData').empty();
                
                // Loop through the returned data and append it to the div
                $.each(data, function(index, cs) {

                    if(cs.status_call_center === "N"){
                        var nameClassCard = "card border-left-danger";
                    }else if(cs.status_call_center === "P"){
                        var nameClassCard = "card border-left-primary";
                    }else if(cs.status_call_center === "H"){
                        var nameClassCard = "card border-left-dark";
                    }else if(cs.status_call_center === "F"){
                        var nameClassCard = "card border-left-warning";
                    }else if(cs.status_call_center === "D"){
                        var nameClassCard = "card border-left-success";
                    }
                    var dataHTML = '<div class="'+nameClassCard+'" onclick="getDetail('+cs.id_history_call_center+')" id="dataCS">'+
                                 '<a class="dropdown-item d-flex align-items-center" href="#">'+
                                     '<div class="dropdown no-arrow mr-2">'+
                                        '<h6 class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                            '<i class="fas fa-ellipsis-v fa-sm fa-fw"></i>'+
                                        '</h6>'+
                                        '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in aria-labelledby="dropdownMenuLink">'+
                                            '<div class="dropdown-header">Options:</div>'+
                                            '<button class="dropdown-item" >Priority</button>'+
                                            '<button class="dropdown-item" >Delete</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="dropdown-list-image mr-3">'+
                                        '<img class="rounded-circle" src="<?= base_url('assets/p/sistem/img/logo.png');?>" alt="...">'+
                                        '<div class="status-indicator bg-success"></div>'+
                                    '</div>'+
                                    '<div class="font-weight-bold">'+
                                        '<div class="text-truncate text-primary">'+cs.customer_phone+"-"+cs.customer_name+'</div>'+
                                        '<div class="small text-truncate">'+cs.nama_lengkap+', Online '+convertSeconds(cs.seconds_since_last_call)+' Ago</div>'+
                                    '</div>'+
                                '</a>'+
                            '</div>';
                    $('#userData').append(dataHTML);
                });
            },
            error: function() {
                alert("Error loading data");
                window.location.href = '<?= base_url("P/Auth/login");?>';
            }
        });
    }

    $('#searchInput').on('keyup', function (e) {
        var ss = $(this).val();
        localStorage.setItem('search', ss);
        fetchData();
    });

    function convertSeconds(seconds) {
        const hours = Math.floor(seconds / 3600); // Calculate hours
        const minutes = Math.floor((seconds % 3600) / 60); // Calculate minutes
        const remainingSeconds = seconds % 60; // Calculate remaining seconds
        
        if(hours > 0){
            return `${hours}h`;
        }
        if(minutes > 0){
            return `${minutes}m`;
        }
        if(remainingSeconds > 0){
            return `${remainingSeconds}s`;
        }
    }

    function getDetail(id){
        $.ajax({
            url: "<?php echo base_url('P/Admin/get_data_call_center_detail'); ?>", // AJAX URL to the controller function
            type: "GET",
            data: { query: id },
            dataType: "json", // Expect JSON data
            success: function(data) {
                // Empty previous data
                $('#id_history_call_center').val(data[0].id_history_call_center);
                $('#nameContact').empty();
                $('#btnPerbaharui').show();
                $('#btnSendWA').show();
                $('#myStatusWa').show();
                $('#nameContact').text(data[0].customer_phone+"-"+data[0].customer_name);
                $('#lastNotes').text("Online Terakhir : "+data[0].last_call);

                $('#myStatusWa').removeClass('bg-danger bg-primary bg-dark bg-warning bg-success');
                if(data[0].status_call_center === "N"){
                    $('#myStatusWa').addClass('bg-danger');
                }else if(data[0].status_call_center === "P"){
                    $('#myStatusWa').addClass('bg-primary');
                }else if(data[0].status_call_center === "H"){
                    $('#myStatusWa').addClass('bg-dark');
                }else if(data[0].status_call_center === "F"){
                    $('#myStatusWa').addClass('bg-warning');
                }else if(data[0].status_call_center === "D"){
                    $('#myStatusWa').addClass('bg-success');
                }

                $('#myStatusWa option[value="'+data[0].status_call_center+'"]').prop('selected', true);

                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0'); 
                const day = String(today.getDate()).padStart(2, '0');
                const formattedDate = `___________________\n${year}-${month}-${day}\n\n`;
                console.log(data);
                if(data[0].notes_call !== ""){
                    var textN = data[0].notes_call + `\n${formattedDate}`;
                }else{
                    var textN = formattedDate + data[0].notes_call;
                }
                $('#floatingTextarea').val(textN);
            },
            error: function() {
                alert("Error loading data");
            }
        });
    }
</script>
</html>