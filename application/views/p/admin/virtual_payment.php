<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
     <script type="text/javascript" src="<?= $url_mitrans;?>" data-client-key="<?= $clientKeyMitrans; ?>"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body id="page-top">
    <form id="payment-form" class="mt-4" method="post" action="<?=site_url()?>P/Payment/finish">
        <input type="hidden" name="result_type" id="result-type" value=""></div>
        <input type="hidden" name="result_data" id="result-data" value=""></div>
        <div class="container-fluid">
        <!-- Page Heading -->
            <div class="d-sm-flex mt-3 align-items-center justify-content-between mb-4">
                <h6 class="h3 mb-0 text-gray-800">Detail Pembayaran</h6>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ID Order #<?= $get_payment['id_order_payment']; ?></h6>
                            <small><?= $get_payment['time_history']; ?></small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="" width="100%" cellpadding="2" border="1">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <td><?= $get_payment['date_payment'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= $get_user['nama_lengkap'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Kelas Belajar</th>
                                            <td><?= $get_master_kelas['nama_kelas'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Metode Bayar</th>
                                            <td><?= $get_booking['metode_bayar'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Tahap Bayar</th>
                                            <td><?= $get_payment['sequence_payment'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Bayar</th>
                                            <td><button class="btn btn-danger"><?= "Rp " . number_format($get_payment['nominal_payment'] + $charge_admin, 0, ',', '.');?></button></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($get_payment['status_payment'] == "P" || $get_payment['status_payment'] == "G"){ ?>
                <button id="pay-button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-credit-card text-white-50"></i> Bayar Sekarang</button>
            <?php }else{ ?>
                <button disabled class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-credit-card text-white-50"></i> Order Telah dibayar !</button>
             <?php } ?>
        </div>
    </form>
</body>


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/p/sistem/');?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/p/sistem/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/p/sistem/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/p/sistem/');?>js/sb-admin-2.min.js"></script>


<!-- Page level plugins -->
<script src="<?= base_url('assets/p/sistem/');?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/p/sistem/');?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/p/sistem/');?>js/demo/datatables-demo.js"></script>

<script type="text/javascript">

    $('#pay-button').click(function (event) {
    event.preventDefault();

    $.ajax({
        url: '<?=site_url()?>P/Payment/token',
        cache: false,
        data: {
            value: {
                id : "<?= $get_payment['id_order_payment']; ?>",
                order_id : "<?= $get_payment['id_virtual_account']; ?>",
                gross_amount : "<?= $get_payment['nominal_payment'] + $charge_admin ; ?>",
                name : "<?= $get_master_kelas['nama_kelas'];?>",
                nama_lengkap : "<?= $get_user['nama_lengkap'];?>",
                handphone : "<?= $get_user['handphone'];?>",
            }  // Ensure this data structure is correct based on your backend needs
        },
        dataType: "JSON",
        method: "GET",
        success: function(data) {
            console.log(data);

            if (data && data.token) {
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    console.log("Type = " + type);
                    console.log(data.token);

                    if (type === 'success') {
                        // alert(data.status_message);
                        // Design HTML for success
                    } else if (type === 'pending') {
                        // alert(data.status_message);
                        // Design HTML for pending
                    } else {
                        // alert(data.status_message);
                        // Design HTML for error
                    }
                }

                snap.pay(data.token, {
                    onSuccess: function(result) {
                        console.log("onSuccess");
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);

                        updateVirtualAccount('<?= $get_payment['id_virtual_account'];?>',result);

                        location.reload();

                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result);
                        console.log("onPending");
                        // Reset or handle `dataItem`
                        var dataItem = []; // Initialize the array if not already done

                        // if(result.payment_type === 'bank_transfer') {
                        //     updateVirtualAccount(result.order_id, result.va_numbers[0].bank, result.va_numbers[0].va_number, result.transaction_id);
                        // }
                        // if(result.biller_code === '70012') {
                        //     updateVirtualAccount(result.order_id, 'mandiri', result.bill_key, result.transaction_id);
                        // }
                        // if(result.payment_type === 'qris') {
                        //     updateVirtualAccount(result.order_id, result.payment_type, '000000000', result.transaction_id);
                        // }

                        // location.reload();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result);
                        console.log("onError");
                        // Reset or handle `dataItem`
                        var dataItem = []; // Initialize the array if not already done

                        alert(result.status_message);
                        // location.reload();
                    }
                });

            } else {
                alert('Error: Token is missing.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
            alert('Virtual Account Telah DiGenerate');
            window.location.href = '<?=site_url('P/Payment/getDetailTransaction/'.$get_payment['id_virtual_account'])?>';
        }
    });
});

function updateVirtualAccount(idOrderVADB, result){
    $.ajax({
      type: "GET", 
      url: "<?php echo base_url('P/Payment/updateVirtualAccount')?>",
      cache: false,
      data:  {
        id_order : '<?= $get_payment['id_order_booking']; ?>',
        idOrderVADB :idOrderVADB,
        result : result,
      },
      dataType: "JSON",
      success: function(data){
        console.log(data);
      }             
    });
  }

</script>