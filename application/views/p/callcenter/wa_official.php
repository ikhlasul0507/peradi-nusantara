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
            font-size: 16px;
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
                position: absolute;
                top: 0;
            }
            #nameCS{
                font-size: 10px;
            }
            .text-label-status{
            position: absolute; /* Make the element positioned relative to the nearest positioned ancestor */
            bottom: 0; /* Align it to the top */
            right: 0; /* Align it to the left */
            padding: 0px; /* Optional: add some padding for better readability */
            font-size: 12px;
            border: 1px solid blue;
        }
        }
    </style>
    <script src="<?= base_url('assets/sweetalert/');?>js/sweetalert2.all.min.js"></script>
</head>

<body class="bg-default"> 
    <div class="">
        <div class="row">
            <!-- Third Column -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header bg-danger d-flex align-items-center justify-content-between">
                        <a href="<?= base_url('P/Admin/main');?>">
                            <i class="fas fa-sign-out-alt text-light fa-lg fa-fw mr-2"></i>
                        </a>
                        <a href="<?= base_url('P/Callcenter/sync');?>" id="showGroup" class="text-light"><i class="fas fa-fw text-light fa-tachometer-alt"></i>Sync</a>
                        <h6 class="m-0 font-weight-bold text-light">Daftar Kontak
                        </h6>
                        <input type="date" value="<?= date('Y-m-d');?>" id="searchDate" class="form-control col-6" name="" minlength="20">
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
    $('#typeGroup').hide();

    localStorage.setItem('search', '');

    fetchData();
    // setInterval(fetchData, 5000); 

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


    $('#searchDate').on('change', function() {
        fetchData();
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
    function changeTypeGroup(valueStatus){
        var id_history_call_center = $('#id_history_call_center').val();
        $.ajax({
            url: "<?php echo base_url('P/Admin/change_type_group_wa_call_center'); ?>", 
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
                $('#typeGroup').show();
                $('#nameContact').text(data[0].customer_phone+"-"+data[0].customer_name);
                $('#nameContactModal').text(data[0].customer_phone+"-"+data[0].customer_name);
                $('#lastNotes').text("Online Terakhir : "+data[0].last_call);
                $('#lastNotesModal').text("Online Terakhir : "+data[0].last_call);

                var linkTOWA = "https://api.whatsapp.com/send/?phone=62"+data[0].customer_phone;
                $('#btnSendWA').attr('href', linkTOWA);
                $('#btnSendWAModal').attr('href', linkTOWA);

                $('#typeGroup').removeClass('bg-danger bg-primary bg-dark bg-warning bg-success');
                if(data[0].type_group === "N"){
                    $('#typeGroup').addClass('bg-danger');
                }else if(data[0].type_group === "P"){
                    $('#typeGroup').addClass('bg-primary');
                }else if(data[0].type_group === "H"){
                    $('#typeGroup').addClass('bg-warning');
                }else if(data[0].type_group === "F"){
                    $('#typeGroup').addClass('bg-success');
                }

                $('#typeGroup option[value="'+data[0].type_group+'"]').prop('selected', true);

                $('#typeGroupModal').removeClass('bg-danger bg-primary bg-dark bg-warning bg-success');
                if(data[0].type_group === "N"){
                    $('#typeGroupModal').addClass('bg-danger');
                }else if(data[0].type_group === "P"){
                    $('#typeGroupModal').addClass('bg-primary');
                }else if(data[0].type_group === "H"){
                    $('#typeGroupModal').addClass('bg-warning');
                }else if(data[0].type_group === "F"){
                    $('#typeGroupModal').addClass('bg-success');
                }

                $('#typeGroupModal option[value="'+data[0].type_group+'"]').prop('selected', true);
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
        value = $('#searchDate').val();
        $.ajax({
            url: "<?php echo base_url('P/Admin/get_data_wa_official'); ?>", // AJAX URL to the controller function
            type: "GET",
            data: { dateToday: value },
            dataType: "json", // Expect JSON data
            success: function(data) {
                // Empty previous data
                $('#userData').empty();
                
                // Loop through the returned data and append it to the div
                $.each(data, function(index, cs) {

                    if(cs.customer_phone === null){
                        var nameClassCard = "card border-left-primary";
                        var bgStatus = "bg-primary";
                        var textToolTip = "Chat Baru"
                    }else {
                        var nameClassCard = "card border-left-success";
                        var bgStatus = "bg-success";
                        var textToolTip = "Chat sudah order";
                    }

                    if(isMobile){
                        if(cs.name.length > 18){
                            cs.name = cs.name.substring(0,18) + "..."
                        }
                    }
                    if(cs.nama_lengkap == null){
                        cs.nama_lengkap = "Stand By..."
                    }

                    var msgSendWa = "hi, "+cs.name+"%0a%0aSilahkan Klik Halaman Berikut %0aUntuk Memulai Chat %0ahttps://app.peradinusantara.org/cs %0a%0aTerima Kasih";
                    var linkTOWA = "https://api.whatsapp.com/send/?phone="+cs.sender+"&text="+msgSendWa;
                    var dataHTML = '<div class="'+nameClassCard+'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="'+textToolTip+'"  id="dataCS">'+
                                 '<a class="dropdown-item d-flex align-items-center" target="blank" href="'+linkTOWA+'">'+
                                    '<div class="dropdown-list-image mr-3">'+
                                        '<img class="rounded-circle" src="<?= base_url('assets/p/img/logo_wa.jpg');?>" alt="...">'+
                                        '<div class="status-indicator bg-success"></div>'+
                                    '</div>'+
                                    '<div class="font-weight-bold">'+
                                        '<div class="text-truncate text-primary" id="nameCustomer">'+cs.sender+"-"+cs.name+'</div>'+
                                        '<div class="small text-truncate font-weight-bold" id="nameCS">Start : '+cs.time_history+'</div>'+
                                    '</div>'+
                                    '<div class="small font-weight-bold '+bgStatus+' text-light text-label-status ">Progress '+cs.nama_lengkap+'</div>'+
                                '</a>'+
                            '</div>';
                    $('#userData').append(dataHTML);
                });
            },
            error: function() {
                // alert("Error loading data");
                // window.location.reload();
            }
        });
    }
</script>
</html>