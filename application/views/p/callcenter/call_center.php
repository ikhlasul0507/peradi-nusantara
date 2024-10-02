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

        .no-arrow{
            margin-top: 10px;
        }
        .dropdown-item{
            padding-left: 0px;
        }
        #nameCustomer{
            white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
        }
        .tab-area{
            display: inline;
        }
        #modalDetail{
            display: none;
        }
        #floatingTextareaModal {
            height: calc(100vh - 180px);/* Maximum height is the full height of the viewport */
            overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
        }
        .text-label-status{
            position: absolute; /* Make the element positioned relative to the nearest positioned ancestor */
            bottom: 0; /* Align it to the top */
            right: 0; /* Align it to the left */
            padding: 0px; /* Optional: add some padding for better readability */
            font-size: 9px;
            border: 1px solid blue;
        }
        #clearSampah{
            display: none;
        }
        @media (max-width: 1366px) {
            .list-contact {
                max-height: calc(110vh - 150px); /* Adjust for mobile devices */
            }
            #nameCustomer{
                font-size: 13px;
            }
        }

        @media (max-width: 896px) {
            .tab-area{
                display: none;
            }
            .list-contact {
                max-height: calc(110vh - 180px); /* Adjust for mobile devices */
            }
            #floatingTextareaModal {
                height: calc(83vh - 180px);/* Maximum height is the full height of the viewport */
                overflow-y: auto; /* Allows scrolling if the content exceeds max-height */
                font-size: 11px;
            }
            #nameCustomer{
                font-size: 11px;
            }
            #nameCS{
                font-size: 10px;
            }
        }
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-default"> 
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
                        <a href="#" id="showGroup"><i class="fa fa-users text-primary ml-2 fa-lg"></i></a>
                        <a href="#" id="showSampah"><i class="fa fa-archive text-dark ml-2 fa-lg"></i></a>
                        <a href="#" id="clearSampah"><i class="fa fa-times text-danger ml-2 fa-lg"></i></a>
                    </div>
                    <div class="card-body list-contact" id="userData" style="padding-left: 15px;">
                        <div class="card border-left-danger">
                             <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="<?= base_url('assets/p/sistem/img/logo.png');?>"
                                        alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate text-primary" id="nameCustomer">Contoh Name</div>
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
                        <select class="form-control col-3 statusWA text-light" id="myStatusWa">
                            <option class="bg-danger text-light" value="N">New Customer</option>
                            <option class="bg-primary text-light" value="P">Process Customer</option>
                            <option class="bg-dark text-light" value="H">Hold Customer</option>
                            <option class="bg-warning text-light" value="F">Follow Up</option>
                            <option class="bg-success text-light" value="D">Done Payment</option>
                        </select>
                        <h5 class="m-0 font-weight-bold text-primary" id="nameContact">
                            <!-- Agung Rilo -->
                        </h5>
                        <a href="#" target="blank" class="btn btn-success btn-circle btn-lg" id="btnSendWA">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="form-floating">
                          <label for="floatingTextarea" id="lastNotes">
                          <!-- Catatan Terakhir : 2024-09-21 12:13:45 -->
                          </label>
                          <textarea class="form-control text-dark bg-default" placeholder="..." id="floatingTextarea"></textarea>
                        </div>
                        <button class="btn btn-primary mt-3" id="btnPerbaharui">Perbaharui Catatan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <div class="modal fade show bd-example-modal-lg" id="modalGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between" id="detailUser">
                    <select class="form-control col-4 ml-2" id="">
                        <option value="" selected>--Pilih Nama Marketing</option>
                        <option value="N">New Customer</option>
                        <option value="N">New Customer</option>
                    </select>
                    <p class="m-0 font-weight-bold ml-2 text-primary" style="font-size: 10px;" id="nameContactModal">
                        <!-- Agung Rilo -->
                    </p>
                    <button class="close" type="button" id="modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                          <label for="floatingTextarea" id="lastNotesModal">
                          <!-- Catatan Terakhir : 2024-09-21 12:13:45 -->
                          </label>
                          <textarea class="form-control text-dark" placeholder="..." id="floatingTextareaModal"></textarea>
                    </div>
                    <button class="btn btn-primary mt-3" id="btnPerbaharuiModal">Perbaharui Catatan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade show" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between" id="detailUser">
                    <input type="hidden" id="id_history_call_center">

                    <a href="#" target="blank" class="btn btn-success btn-circle btn-sm" id="btnSendWAModal">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    </a>

                    <select class="form-control col-4 ml-2 statusWA text-light" style="font-size: 10px;" id="myStatusWaModal">
                        <option class="bg-danger text-light" value="N">New Customer</option>
                        <option class="bg-primary text-light" value="P">Process Customer</option>
                        <option class="bg-dark text-light" value="H">Hold Customer</option>
                        <option class="bg-warning text-light" value="F">Follow Up</option>
                        <option class="bg-success text-light" value="D">Done Payment</option>
                    </select>
                    <p class="m-0 font-weight-bold ml-2 text-primary" style="font-size: 10px;" id="nameContactModal">
                        <!-- Agung Rilo -->
                    </p>
                    <button class="close" type="button" id="modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                          <label for="floatingTextarea" id="lastNotesModal">
                          <!-- Catatan Terakhir : 2024-09-21 12:13:45 -->
                          </label>
                          <textarea class="form-control text-dark" placeholder="..." id="floatingTextareaModal"></textarea>
                    </div>
                    <button class="btn btn-primary mt-3" id="btnPerbaharuiModal">Perbaharui Catatan</button>
                </div>
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
    setInterval(fetchData, 5000); 

    function detectDeviceWidth() {
      const width = window.innerWidth; // Get the viewport width
      console.log('Device width:', width + 'px');

      // Show the width on the page
      // document.getElementById("deviceWidthDisplay").innerText = "Device width: " + width + "px";

      // Optionally, you can check for specific ranges
      if (width >= 1200) {
        console.log("This is likely a desktop or laptop.");
      } else if (width >= 768 && width < 1200) {
        console.log("This is likely a tablet or smaller laptop.");
      } else {
        console.log("This is likely a mobile device.");
      }
    }

    // Call the function on page load
    window.onload = detectDeviceWidth;

    // Update the width if the window is resized
    window.onresize = detectDeviceWidth;

   

     
    $('#showGroup').on('click', function (e) {
        document.getElementById('modalGroup').style.display = "block";
    });

    $('#showSampah').on('click', function (e) {
        localStorage.setItem('search', "showSampah");
        document.getElementById("showSampah").style.display = "none";
        document.getElementById("clearSampah").style.display = "inline";
        fetchData();
    });

     $('#clearSampah').on('click', function (e) {
        localStorage.setItem('search', "");
        document.getElementById("clearSampah").style.display = "none";
        document.getElementById("showSampah").style.display = "inline";
        fetchData();
    });
    $('#searchInput').on('keyup', function (e) {
        var ss = $(this).val();
        localStorage.setItem('search', ss);
        fetchData();
    });
    $('#myStatusWa').on('change', function() {
        var selectedValue = $(this).val(); // Get the selected value
        changeStatusWA(selectedValue);
    });
    $('#myStatusWaModal').on('change', function() {
        var selectedValue = $(this).val(); // Get the selected value
        changeStatusWA(selectedValue);
    });
    

    $('#btnPerbaharui').on('click', function() {
        var id_history_call_center = $('#id_history_call_center').val();
        var floatingTextarea = $('#floatingTextarea').val();
        updateNotesWa(id_history_call_center,floatingTextarea);
    });

    $('#btnPerbaharuiModal').on('click', function() {
        var id_history_call_center = $('#id_history_call_center').val();
        var floatingTextarea = $('#floatingTextareaModal').val();
        updateNotesWa(id_history_call_center,floatingTextarea);
    });

    $('#modalClose').on('click', function() {
        document.getElementById('modalDetail').style.display = "none";
        document.getElementById('modalGroup').style.display = "none";
    });
    
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    function updateNotesWa(id, value){
        $.ajax({
            url: "<?php echo base_url('P/Admin/update_notes_wa_call_center'); ?>", 
            type: "POST",
            data: { 
                query: id,
                value : value,
                [csrfName]: csrfHash 
            },
            dataType: "json", // Expect JSON data
            success: function(data) {
                if(data.status_code === 200){
                    getDetail(id);
                }else{
                    alert("Gagal update data");
                }
            },
            error: function() {
                alert("Error loading data");
                // window.location.href = '<?= base_url("P/Auth/login");?>';
            }
        });
    }
    function changeStatusWA(valueStatus){
        var id_history_call_center = $('#id_history_call_center').val();
        $.ajax({
            url: "<?php echo base_url('P/Admin/change_status_wa_call_center'); ?>", 
            type: "GET",
            data: { query: id_history_call_center+"-"+valueStatus },
            dataType: "json", // Expect JSON data
            success: function(data) {
                if(data.status_code === 200){
                    getDetail(id_history_call_center);
                }else{
                    alert("Gagal update data");
                }
            },
            error: function() {
                alert("Error loading data");
                window.location.href = '<?= base_url("P/Auth/login");?>';
            }
        });
    }

    function focusTextarea() {
        var $textarea = $('#floatingTextarea');
        $textarea.focus();
        $textarea[0].setSelectionRange($textarea.val().length, $textarea.val().length);
    }

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

    function changePriority(id) {
        $.ajax({
            url: "<?php echo base_url('P/Admin/update_priority_wa_call_center'); ?>", 
            type: "GET",
            data: { 
                query: id
            },
            dataType: "json", // Expect JSON data
            success: function(data) {
                if(data.status_code === 200){
                    fetchData();
                }else{
                    alert("Gagal update data");
                }
            },
            error: function() {
                alert("Error loading data");
                // window.location.href = '<?= base_url("P/Auth/login");?>';
            }
        });
        // body...
    }
    function deleteCS(id, value) {
        if(value > 0){
            value = "Y"
        }else{
            value = "N"
        }
        $.ajax({
            url: "<?php echo base_url('P/Admin/delete_wa_call_center'); ?>", 
            type: "GET",
            data: { 
                query: id,
                value: value
            },
            dataType: "json", // Expect JSON data
            success: function(data) {
                if(data.status_code === 200){
                    fetchData();
                }else{
                    alert("Gagal update data");
                }
            },
            error: function() {
                alert("Error loading data");
                // window.location.href = '<?= base_url("P/Auth/login");?>';
            }
        });
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
                $('#nameContactModal').text(data[0].customer_phone+"-"+data[0].customer_name);
                $('#lastNotes').text("Online Terakhir : "+data[0].last_call);
                $('#lastNotesModal').text("Online Terakhir : "+data[0].last_call);

                var linkTOWA = "https://api.whatsapp.com/send/?phone=62"+data[0].customer_phone;
                $('#btnSendWA').attr('href', linkTOWA);
                $('#btnSendWAModal').attr('href', linkTOWA);

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

                $('#myStatusWaModal').removeClass('bg-danger bg-primary bg-dark bg-warning bg-success');
                if(data[0].status_call_center === "N"){
                    $('#myStatusWaModal').addClass('bg-danger');
                }else if(data[0].status_call_center === "P"){
                    $('#myStatusWaModal').addClass('bg-primary');
                }else if(data[0].status_call_center === "H"){
                    $('#myStatusWaModal').addClass('bg-dark');
                }else if(data[0].status_call_center === "F"){
                    $('#myStatusWaModal').addClass('bg-warning');
                }else if(data[0].status_call_center === "D"){
                    $('#myStatusWaModal').addClass('bg-success');
                }

                $('#myStatusWaModal option[value="'+data[0].status_call_center+'"]').prop('selected', true);
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
                $('#floatingTextarea').attr('spellcheck', false);

                $('#floatingTextareaModal').val(textN);
                $('#floatingTextareaModal').attr('spellcheck', false);

                focusTextarea();

                if (window.innerWidth <= 896) {
                    // Show the modal
                    document.getElementById('modalDetail').style.display = "block";
                    var $textarea = $('#floatingTextareaModal');
                    $textarea.focus();
                    $textarea[0].setSelectionRange($textarea.val().length, $textarea.val().length);
                }
            },
            error: function() {
                alert("Error loading data");
            }
        });
    }

    function fetchData(value = "") {
        var isMobile = false;
        if (window.innerWidth <= 896) {
            isMobile = true;
        }
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
                        var nameClassCard = "card border-left-primary";
                        var bgStatus = "bg-primary";
                        var textToolTip = "Chat Baru"
                    }
                    if(parseInt(cs.hours_since_last_call) > (1 * 24)){
                        var nameClassCard = "card border-left-danger";
                        var bgStatus = "bg-danger";
                        var textToolTip = "Chat No Respon 1x24 jam";
                    }
                    if(parseInt(cs.hours_since_last_call) > (3 * 24)){
                        var nameClassCard = "card border-left-dark";
                        var bgStatus = "bg-dark";
                        var textToolTip = "Chat No Respon 3x24 jam";
                    }

                    if(cs.status_call_center === "P"){
                        var nameClassCard = "card border-left-warning";
                        var bgStatus = "bg-warning";
                        var textToolTip = "Follow Up Chat";
                    }

                    if(cs.id_virtual_account !== null){
                        var nameClassCard = "card border-left-success";
                        var bgStatus = "bg-success";
                        var textToolTip = "Chat sudah order";
                    }
                    // else if(cs.status_call_center === "P"){
                    //     var nameClassCard = "card border-left-primary";
                    //     var bgStatus = "bg-primary";
                    // }else if(cs.status_call_center === "H"){
                    //     var nameClassCard = "card border-left-dark";
                    //     var bgStatus = "bg-dark";
                    // }else if(cs.status_call_center === "F"){
                    //     var nameClassCard = "card border-left-warning";
                    //     var bgStatus = "bg-warning";
                    // }else if(cs.status_call_center === "D"){
                    //     var nameClassCard = "card border-left-success";
                    //     var bgStatus = "bg-success";
                    // }
                    if(cs.is_deleted === "N"){
                        var buttonSampah = '<button class="dropdown-item" onclick="deleteCS('+cs.id_history_call_center+',1)">Pindahkan ke Sampah</button>';
                    }else{
                        var buttonSampah = '<button class="dropdown-item" onclick="deleteCS('+cs.id_history_call_center+',0)">Pindahkan Dari Sampah</button>';
                    }
                    if(isMobile){
                        if(cs.customer_name.length > 18){
                            cs.customer_name = cs.customer_name.substring(0,18) + "..."
                        }
                    }
                    var dataHTML = '<div class="'+nameClassCard+'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="'+textToolTip+'"  id="dataCS">'+
                                 '<a class="dropdown-item d-flex align-items-center" href="#">'+
                                     '<div class="dropdown no-arrow mr-2">'+
                                        '<h6 class="dropdown-toggle '+bgStatus+'" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                            '<i class="fas fa-ellipsis-v fa-lg fa-fw"></i>'+
                                        '</h6>'+
                                        '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in aria-labelledby="dropdownMenuLink">'+
                                            '<div class="dropdown-header">Options:</div>'+
                                            '<button class="dropdown-item" onclick="changePriority('+cs.id_history_call_center+')">Priority</button>'+
                                            buttonSampah+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="dropdown-list-image mr-3">'+
                                        '<img class="rounded-circle" src="<?= base_url('assets/p/img/');?>'+cs.foto_ktp+'" alt="...">'+
                                        '<div class="status-indicator bg-success"></div>'+
                                    '</div>'+
                                    '<div class="font-weight-bold" onclick="getDetail('+cs.id_history_call_center+')">'+
                                        '<div class="text-truncate text-primary" id="nameCustomer">'+cs.customer_phone+"-"+cs.customer_name+'</div>'+
                                        '<div class="small text-truncate font-weight-bold" id="nameCS">'+cs.nama_lengkap+', Online '+convertSeconds(cs.seconds_since_last_call)+' Ago</div>'+
                                    '</div>'+
                                    '<div class="small font-weight-bold text-label-status ">'+textToolTip+'</div>'+
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
</script>
</html>