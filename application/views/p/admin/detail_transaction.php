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
    
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body id="page-top">
        <input type="hidden" name="result_type" id="result-type" value=""></div>
        <input type="hidden" name="result_data" id="result-data" value=""></div>
        <div class="container-fluid">
        <!-- Page Heading -->
            <div class="d-sm-flex mt-3 align-items-center justify-content-between mb-4">
                <h6 class="h3 mb-0 text-gray-800">Detail Pembayaran</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tipe Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="" width="100%" cellpadding="2" border="1">
                                        <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Value</th>
                                        </tr>
                                        <tr>
                                            <td>Transaction Status</td>
                                            <td><?= htmlspecialchars($transaction->transaction_status) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Virtual Account Bank</td>
                                            <td><h1><?= htmlspecialchars($transaction->va_numbers[0]->bank) ?></h1></td>
                                        </tr>
                                        <?php if($transaction->va_numbers[0]->va_number == "Y") {?>
                                        <tr>
                                            <td colspan="2">
                                                <img src="https://api.midtrans.com/v2/qris/<?= htmlspecialchars($transaction->transaction_id);?>/qr-code" style="width: 300px; height: 300px;">
                                                <a href="https://api.midtrans.com/v2/qris/<?= htmlspecialchars($transaction->transaction_id);?>/qr-code">Download Gambar</a>
                                            </td>
                                        </tr>
                                        <?php }else{ ?>
                                        <tr>
                                            <td>Virtual Account Number</td>
                                            <td>
                                                 <input type="text" value="<?= htmlspecialchars($transaction->va_numbers[0]->va_number);?>" id="copyText" readonly>
                                                <button class="btn btn-primary" onclick="copyText()">Salin Kode</button>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <!-- <tr>
                                            <td>Status Code</td>
                                            <td><?= htmlspecialchars($transaction->status_code) ?></td>
                                        </tr> -->
                                       <!--  <tr>
                                            <td>Transaction ID</td>
                                            <td><?= htmlspecialchars($transaction->transaction_id) ?></td>
                                        </tr> -->
                                        <tr>
                                            <td>Gross Amount</td>
                                            <td>
                                                <h4>
                                                 <?= "Rp " . number_format(htmlspecialchars($transaction->gross_amount), 0, ',', '.');?>
                                                <h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Type</td>
                                            <td><?= htmlspecialchars($transaction->payment_type) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Time</td>
                                            <td><?= htmlspecialchars($transaction->transaction_time) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Expiry Time</td>
                                            <td><?= htmlspecialchars($transaction->expiry_time) ?></td>
                                        </tr>

                                        <tr>
                                            <td>Payment Amount</td>
                                            <td><?= htmlspecialchars($transaction->payment_amounts[0]->amount) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Payment Date</td>
                                            <td><?= htmlspecialchars($transaction->payment_amounts[0]->paid_at) ?></td>
                                        </tr>
                                       <!--  <tr>
                                            <td>Currency</td>
                                            <td><?= htmlspecialchars($transaction->currency) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Order ID</td>
                                            <td><?= htmlspecialchars($transaction->order_id) ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td>Signature Key</td>
                                            <td><?= htmlspecialchars($transaction->signature_key) ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Fraud Status</td>
                                            <td><?= htmlspecialchars($transaction->fraud_status) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Message</td>
                                            <td><?= htmlspecialchars($transaction->status_message) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Merchant ID</td>
                                            <td><?= htmlspecialchars($transaction->merchant_id) ?></td>
                                        </tr> -->
                             
                                        
                                        </thead>
                                    </table>
                                    <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4 mt-3">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Langkah Pembayaran (Tekan Tombol Salin Kode)</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="collapseCardExample">
                                    <div class="card-body">
                                        <?= $transaction->langkahPembayaran;?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
 <script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("copyText");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            document.execCommand("copy");

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>
