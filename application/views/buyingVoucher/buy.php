<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Bujang Gadis Lahat</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets/desain-buying/'); ?>css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?= base_url('assets/desain-buying/'); ?>css/bootstrap-icons.css" />

    <link rel="stylesheet" href="<?= base_url('assets/desain-buying/'); ?>css/owl.carousel.min.css" />

    <link rel="stylesheet" href="<?= base_url('assets/desain-buying/'); ?>css/owl.theme.default.min.css" />

    <link href="<?= base_url('assets/desain-buying/'); ?>css/templatemo-pod-talk.css" rel="stylesheet" />
    <link rel="icon" href="<?= base_url('assets/desain-buying/'); ?>images/pod-talk-logo.png" />
</head>
<style type="text/css">
        
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
            color: #34495e;
            opacity: 10;
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
        /*-- responsive --*/
        .table tr .selected {
            background-color: silver;
            color: black;
        }
        .table tr .selected a {
            background-color: silver;
            color: black;
        }
        .page-title{
            margin-top: -20px; 
            margin-bottom: -20px;
        }
    </style>
<body>
    <main>
         <div id="loading">
        <span class="loader"></span>
        <div class="textLoader">
            <center>
            <b><h1>Please Wait ... </h1></b>
            <h5>Do Not Refresh Page</h5>
            </center>
        </div>
    </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand me-lg-5 me-0" href="index.html">
                    <img src="<?= base_url('assets/desain-buying/'); ?>images/logo-buy.png" class="logo-image img-fluid rounded-circle" alt="templatemo pod talk" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto">
                        <div class="ms-4">
                            <a href="<?= base_url($urlRedirect); ?>" class="btn custom-btn custom-border-btn smoothscroll">Home</a>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="text-center mb-5 pb-2">
                            <h1 class="text-white">Voucher Online</h1>

                            <p class="text-white">Cek Status Pembelian Voucher</p>

                            <form action="#" method="get" class="custom-form search-form flex-fill me-3" role="search">
                                <div class="input-group input-group-lg">
                                    <input name="search" class="form-control" id="valueSearch" type="search" placeholder="Masukan handphone" aria-label="Search" />

                                    <button type="button" id="tombolku" class="btn btn-danger">
                                        <i class="bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="owl-carousel owl-theme">
                            <div class="owl-carousel-info-wrap item">
                                <img style="height: 250px" src="<?= base_url('assets/desain-buying/'); ?>images/logo-buy.png" class="owl-carousel-image img-fluid" alt="" />

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">
                                        Buy...
                                        <img src="<?= base_url('assets/desain-buying/'); ?>images/verified.png" class="owl-carousel-verified-image img-fluid" alt="" />
                                    </h4>

                                    <span class="badge">Klik here</span>
                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalBeli" class="social-icon-link">BELI</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer"></footer>

    <!-- Modal cari-->
    <div class="modal fade" id="modalCari" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: black" id="staticBackdropLabel">
                        List pembelian voucher
                    </h5>
                    <button type="button" class="close" id="tutupCari">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-data" style="
								border: 2px solid black;
								border-radius: 20px;
								padding: 10px;
							">
                        <div id="dataTableCari"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal beli -->
    <div class="modal fade" id="modalBeli" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: black" id="staticBackdropLabel">
                        Beli voucher
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-data" style="
								border: 2px solid black;
								border-radius: 20px;
								padding: 10px;
							">
                        <div class="form-group">
                            <div id="page1">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Nama
                                            </label>
                                        </td>
                                        <td>
                                            <input name="search" type="text" id="nama" size="25" placeholder="Masukan Nama" autocomplete autofocus />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Handphone
                                            </label>
                                        </td>
                                        <td>
                                            <input name="search" type="number" id="handphone" size="25" placeholder="Masukan Handphone" autocomplete />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Email
                                            </label>
                                        </td>
                                        <td>
                                            <input name="search" type="email" id="email" size="25" placeholder="Masukan Email" autocomplete />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Total Transfer
                                            </label>
                                        </td>
                                        <td>
                                            <input name="search" type="number" id="totalBayar" size="25" placeholder="Total Sudah di Transfer Contoh ( 20000 )" autocomplete />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Bukti
                                            </label>
                                        </td>
                                        <td>
                                            <input name="search" type="file" size="25" id="uploadBuktiBayar" placeholder="Upload Bukti Bayar" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-success" id="add-lanjut" type="button">
                                                Lanjut
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="page2" style="display: none">
                                <table>
                                    <h5 id="saldoVoucher"></h5>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Pilih Voucher
                                            </label>
                                        </td>
                                        <td>
                                            <select id="voucher">
                                                <option value="">--Pilih Voucher---</option>
                                                <?php
                                                $a = $this->db->query("SELECT * FROM
													tbl_parameter where
													namaParameter='@optionsNominalVoucher'")->row_array();
                                                $val = $a['valueParameter'];
                                                $arrayString = explode(
                                                    ",",
                                                    $val
                                                );
                                                for (
                                                    $i = 0;
                                                    $i < count($arrayString);
                                                    $i++
                                                ) { ?>
                                                    <option value="<?= $arrayString[$i]; ?>">
                                                        <?= "Rp. " . number_format($arrayString[$i], 0, ',', '.'); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="voucher" style="color: black; font-size: 12px">Total Voucher
                                            </label>
                                        </td>
                                        <td>
                                            <input name="search" type="number" id="jumlah" placeholder="Masukan Jumlah Voucher" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="badge badge-danger" id="add-button" type="button">
                                                Tambah Item
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <table id="dataTable" style="display: none; margin-top: 10px; margin-bottom: 10px" border="1px">
                        </table>

                        <button class="btn btn-danger" id="pay-button" type="button">
                            Lanjut Pembelian
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tata cara beli -->
    <div class="modal fade" id="modalInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: black" id="staticBackdropLabel">
                        Tata cara beli voucher
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" id="tutup">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="right-content">
                            <div class="h-100">
                                <ol class="list-group list-group-numbered mb-3">
                                    <li class="list-group-item">
                                        <b>Tranfer melalui ATM/Bank (No Rek Bank Sumsel Babel :
                                            14209018306) a.n Yayasan Bujang Gadis Lahat</b>
                                    </li>
                                    <li class="list-group-item">
                                        Buka website https://bglahat.org/ lalu pilih menu "Beli
                                        Voucher"
                                    </li>
                                    <li class="list-group-item">
                                        Masukan data diri seperti nama lengkap,nomor
                                        whatsapp,email,total transfer, bukti transfer, pilih
                                        voucher, dan jumlah voucher
                                    </li>
                                    <li class="list-group-item">
                                        Masukan nominal voucher yang akan kalian beli
                                    </li>
                                    <li class="list-group-item">
                                        Upload Bukti pembayaran sesuai dengan nominal voucher yang
                                        kalian beli, pembayaran dapat melalui ATM/Bank (No Rek
                                        Bank Sumsel Babel : 14209018306) a.n Yayasan Bujang Gadis
                                        Lahat
                                    </li>
                                    <li class="list-group-item">
                                        Bukti tranfer hanya berlaku di hari yang sama dengan
                                        pengisian data pembelian voucher,
                                    </li>
                                    <li class="list-group-item">
                                        Setelah pembayaran selesai kode Voucher akan dikirimkan
                                        melalui whatsapp atau bisa dicek di halaman menu E-Voucher
                                        (pada bagian "Lakukan Pengecekan E-Voucher Anda")
                                    </li>
                                    <li class="list-group-item">
                                        Setelah mendapatkan VOUCHER masuk ke halaman VOTE kemudian
                                        cari Finalis Favorit kalian dan lakukan Voting dengan cara
                                        memasukan kode voucher yang sudah dibeli.
                                    </li>
                                    <li class="list-group-item">Voting Berhasil!</li>
                                    <li class="list-group-item">
                                        Grafik hasil e-voting otomatis langsung terupdate
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="<?= base_url('assets/desain-buying/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/desain-buying/'); ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/desain-buying/'); ?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/desain-buying/'); ?>js/custom.js"></script>
    <script src="<?= base_url('assets/sweetalert/'); ?>js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $("#loading").hide();
        $(".loader").hide();

        let dataItem = [];
        let number = 1;
        var totalSemuaBayar = 0;
        var modalInfo = document.getElementById("modalInfo");
        var btn = document.getElementById("tombolku");
        var span = document.getElementById("tutup");
        var tutupCari = document.getElementById("tutupCari");

        document.getElementById("pay-button").style.display = "none";
        // modalInfo.style.display = "block";
        // modalInfo.classList.add("show");

        tutupCari.onclick = function() {
            document.getElementById("modalCari").style.display = "none";
            document.getElementById("valueSearch").value = "";
            location.reload();
        };
        $("#add-lanjut").click(function(event) {
            var nama = document.getElementById("nama").value;
            var handphone = document.getElementById("handphone").value;
            var email = document.getElementById("email").value;
            var voucher = document.getElementById("voucher").value;
            var jumlah = document.getElementById("jumlah").value;
            var totalBayar = document.getElementById("totalBayar").value;
            var uploadBuktiBayar =
                document.getElementById("uploadBuktiBayar").value;
            if (
                nama !== "" &&
                handphone !== "" &&
                email !== "" &&
                totalBayar !== "" &&
                uploadBuktiBayar !== ""
            ) {
                document.getElementById("page1").style.display = "none";
                document.getElementById("page2").style.display = "block";
                document.getElementById("saldoVoucher").innerHTML =
                    "Saldo Voucher : Rp." + totalBayar;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Harap Lengkapi Data",
                    type: "error",
                });
            }
        });
        $("#add-button").click(function(event) {
            var nama = document.getElementById("nama").value;
            var handphone = document.getElementById("handphone").value;
            var email = document.getElementById("email").value;
            var voucher = document.getElementById("voucher").value;
            var jumlah = document.getElementById("jumlah").value;
            var totalBayar = document.getElementById("totalBayar").value;
            var uploadBuktiBayar =
                document.getElementById("uploadBuktiBayar").value;
            if (
                nama !== "" &&
                handphone !== "" &&
                email !== "" &&
                voucher !== "" &&
                jumlah !== "" &&
                totalBayar !== "" &&
                uploadBuktiBayar !== ""
            ) {
                let item = {
                    no: number,
                    nama: document.getElementById("nama").value,
                    handphone: document.getElementById("handphone").value,
                    email: document.getElementById("email").value,
                    voucher: parseInt(document.getElementById("voucher").value),
                    jumlah: parseInt(document.getElementById("jumlah").value),
                    uploadBuktiBayar: $("#uploadBuktiBayar").prop("files")[0].name,
                };
                if (cekNilaiVc(document.getElementById("voucher").value)) {
                    Swal.fire({
                        icon: "error",
                        title: "voucher sudah di input",
                        type: "error",
                    });
                } else if (totalBayar < totalSemuaBayar + voucher * jumlah) {
                    Swal.fire({
                        icon: "error",
                        title: "Total nominal voucher melebihi saldo",
                        type: "error",
                    });
                } else {
                    document.getElementById("dataTable").style.display = "block";
                    dataItem.push(item);
                    number++;
                    addtable();
                    document.getElementById("pay-button").style.display = "inline";
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Harap Lengkapi Data",
                    type: "error",
                });
            }
        });

        function cekNilaiVc(vc) {
            let nilai = false;
            for (var key in dataItem) {
                if (dataItem[key].voucher == vc) {
                    nilai = true;
                }
            }
            return nilai;
        }

        function addtable() {
            if (dataItem.length > 0) {
                let dataTab =
                    '<thead style="background-color: black;color:white"><th>Nominal Voucher</th><th>Jumlah</th><th>Status</th></thead >';
                let totalJml = 0;
                let totalVc = 0;
                for (var key in dataItem) {
                    let obj = dataItem[key];
                    dataTab +=
                        "<tbody><tr><td>" +
                        formatUang(obj.voucher) +
                        "</td><td>" +
                        obj.jumlah +
                        "</td><td><button class='btn btn-warning' onclick='hapus(" +
                        obj.no +
                        ")'><i class='bi-trash'></i></button></td></tr></tbody>";
                    totalVc += obj.voucher * obj.jumlah;
                    totalJml += obj.jumlah;
                }
                totalSemuaBayar = totalVc;
                dataTab +=
                    "<tr><td colspan='2'>Total</td><td>" +
                    formatUang(totalVc) +
                    "</td></tr>";
                document.getElementById("dataTable").innerHTML = dataTab;
            } else {
                document.getElementById("dataTable").style.display = "none";
                document.getElementById("pay-button").style.display = "none";
                location.reload();
            }
        }

        function hapus(id) {
            console.log(id);
            for (var key in dataItem) {
                if (dataItem[key].no == id) {
                    dataItem.splice(key, 1);
                }
            }
            addtable();
        }

        function prosesUpload(id) {
            var result = "";
            var photoPelayanan = $("#uploadBuktiBayar").val();
            if (photoPelayanan !== "") {
                var file_data = $("#uploadBuktiBayar").prop("files")[0];
                var form_data = new FormData();

                form_data.append("file", file_data);
                form_data.append("text", $("#email").val());

                $.ajax({
                    url: "<?php echo base_url(); ?>Snap/uploadPhoto/" + id,
                    type: "post",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(data) {
                        if (data.status === "success") {
                            result = data.status;
                        } else {
                            result = "error";
                        }
                    },
                });
            } else {
                alert("Harap Pilih Photo", "error");
            }
            return result;
        }

        $("#pay-button").click(function(event) {
            $("#loading").show();
            $(".loader").show();

            console.log("totalBayar = " + totalBayar);
            console.log("totalSemuaBayar = " + totalSemuaBayar);
            const d = new Date();
            var idFoto = d.getTime();
            var totalBayar = document.getElementById("totalBayar").value;

            if (totalBayar > totalSemuaBayar) {
                Swal.fire({
                    icon: "error",
                    title: "Total nominal voucher harus sama dengan saldo voucher, silahkan tambah item voucher",
                    type: "error",
                });
            } else {
                document.getElementById("pay-button").disabled = true;
                var cekUpload = prosesUpload(idFoto);
                console.log("SIMPAN DATA");
                console.log(cekUpload);
                if (cekUpload !== "error") {
                    if (dataItem != "") {
                        $.ajax({
                            url: "<?= site_url() ?>/snap/tokenManual",
                            cache: false,
                            data: {
                                data: dataItem,
                                idFoto: idFoto,
                            },
                            dataType: "JSON",
                            method: "GET",
                            success: function(data) {
                                //location = data;
                                if (data.status === "200") {
                                    $("#loading").hide();
                                    $(".loader").hide();

                                    Swal.fire({
                                        icon: "success",
                                        title: "Berhasil, Sedang Verifikasi, Cek Berkala Pembelian !",
                                        type: "success",
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: data.value,
                                        type: "error",
                                    }).then(function() {
                                        location.reload();
                                    });
                                }
                            },
                        });
                    } else {
                        alert("Masukan Item Voucher");
                    }
                } else {
                    alert("Harap Masukan Format JPG|PNG");
                    location.reload();
                }
            }
        });

        function updateVirtualAccount(idVal, typeval, vaval) {
            console.log(vaval);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('snap/updateVirtualAccount') ?>",
                cache: false,
                data: {
                    id: idVal,
                    type: typeval,
                    va: vaval,
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                },
            });
        }

        function updateTransferDone(idVal, typeval, vaval) {
            console.log(vaval);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('snap/updateTransferDone') ?>",
                cache: false,
                data: {
                    id: idVal,
                    type: typeval,
                    va: vaval,
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                },
            });
        }

        function myFunctionCopy(t) {
            navigator.clipboard.writeText(t);
            Swal.fire({
                icon: "success",
                title: "Voucher " + t + " di salin, Klik OK Untuk Vote Peserta",
                type: "success",
            }).then(function() {
                window.location = "<?= base_url($urlRedirect); ?>";
            });
        }
        //for modal

        document.getElementById("valueSearch").onkeypress = function(evt) {
            var charCode = evt.which ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        };
        btn.onclick = function() {
            var valueSearch = document.getElementById("valueSearch").value;
            if (valueSearch !== "") {
                if (valueSearch.length < 10) {
                    Swal.fire({
                        icon: "error",
                        title: "Masukan handphone lebih dari 10 digit",
                        type: "error",
                    });
                } else {
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url('snap/searchDataSellingVoucherManual') ?>",
                        cache: false,
                        data: {
                            valueSearch: valueSearch,
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.length > 0) {
                                var modalCari = document.getElementById("modalCari");
                                modalCari.classList.add("show");
                                modalCari.style.display = "block";
                                addToTableModal(data);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Data tidak ditemukan !",
                                    type: "error",
                                });
                            }
                        },
                    });
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Masukan handphone !",
                    type: "error",
                });
            }
        };

        function formatUang(subject) {
            rupiah = subject.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            return `Rp ${rupiah}`;
        }
        span.onclick = function() {
            modalInfo.style.display = "none";
            document.getElementById("valueSearch").value = "";
        };

        // window.onclick = function (e) {
        // 	if (e.target == modalInfo) {
        // 		modal.style.display = "none";
        // 		document.getElementById("valueSearch").value = "";
        // 	}
        // };
        function addToTableModal(data) {
            var html = "";

            for (var i = 0; i < data.length; i++) {
                var vc = data[i].vouchermanual;
                var nama = vc.nama;
                var handphone = vc.handphone;
                var email = vc.email;
                var totalVoucher = vc.totalVoucher;
                var totalBayar = vc.totalBayar;
                var typetransfer = vc.typetransfer;
                var virtualAccount = vc.uploadBuktiBayar;
                var dateCreatedAdd = vc.dateCreatedAdd;
                var statusVoucher = vc.statusBayar;
                var bg = "";
                var text = "";

                if (statusVoucher === "N") {
                    bg = "red";
                    text = "PROSES VERIFIKASI";
                } else if (statusVoucher === "H") {
                    bg = "yellow";
                    text = "HOLD, SEGERA LAKUKAN PEMBAYARAN";
                } else if (statusVoucher === "D") {
                    bg = "#20fc03";
                    text = "VOUCHER TELAH TERBIT";
                } else if (statusVoucher === "E") {
                    bg = "black";
                    text = "EXPIRED, SILAHKAN LAKUKAN PEMBELIAN";
                }
                var buttonCPVA = "";

                html +=
                    '<div class="card-header" style="background-color: ' +
                    bg +
                    '"><h3>' +
                    text +
                    "</h3><small>Tanggal Pembelian : " +
                    dateCreatedAdd +
                    '</small></div><div class="card-body"><div class="table-responsive"><table border="1px" cellpadding="5px" id="dataTableCari" width="100%" cellspacing="0">';
                html += "<tbody>";
                html +=
                    '<tr><td style="background-color: black;color: white">Nama</td><td>' +
                    nama +
                    "</td></tr>";
                html +=
                    '<tr><td style="background-color: black;color: white">Handphone</td><td>' +
                    handphone +
                    "</td></tr>";
                html +=
                    '<tr><td style="background-color: black;color: white">Total Voucher</td><td>' +
                    totalVoucher +
                    "</td></tr>";
                html +=
                    '<tr><td style="background-color: black;color: white">Total Bayar</td><td>' +
                    formatUang(totalBayar); +
                "</td></tr>";
                html +=
                    '<tr><td style="background-color: black;color: white">Type Transfer</td><td>' +
                    typetransfer +
                    "</td></tr>";

                var vcitem = data[i].vouchermanualitem;
                if (statusVoucher === "D") {
                    html +=
                        '<tr ><td colspan="2"><table border="1px" cellpadding="5px" id="dataTable" width="100%" cellspacing="0">';
                    html +=
                        '<tr style="background-color: black;color: white"><td>Kode Voucher</td><td>Nominal</td><td>Status</td></tr>';
                    for (var y = 0; y < vcitem.length; y++) {
                        var vcit = vcitem[y];
                        var kodeVoucher = vcit.kodeVoucher;
                        var nominalVoucher = vcit.nominalVoucher;
                        var statusVoucher = vcit.statusVoucher;
                        var dateCreatedVoucher = vcit.dateCreatedVoucher;
                        var bgitem = "";
                        var textitem = "";
                        var buttonSalin =
                            '<button class="badge badge-dark" onclick="myFunctionCopy(\'' +
                            kodeVoucher +
                            "')\">Copy</button>";
                        if (statusVoucher === "D") {
                            bgitem = "red";
                            textitem = "NEW";
                        } else if (statusVoucher === "H") {
                            bgitem = "yellow";
                            textitem = "HOLD";
                        } else if (statusVoucher === "N") {
                            bgitem = "#20fc03";
                            textitem = "NEW";
                        } else if (statusVoucher === "E") {
                            bgitem = "red";
                            textitem = "EXPIRED";
                            buttonSalin = "";
                        }
                        html +=
                            "<tr><td>" +
                            buttonSalin +
                            kodeVoucher +
                            "</td><td>" +
                            formatUang(nominalVoucher) +
                            '</td><td style="background-color: ' +
                            bgitem +
                            '">' +
                            textitem +
                            "</td></tr>";
                    }
                    html += "</table></td></tr>";
                }
                html += "<tbody></table></div><hr></div></div>";
            }
            document.getElementById("dataTableCari").innerHTML = html;
        }
    </script>
</body>

</html>