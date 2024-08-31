         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Detail Voucher Auto</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>ID Transaksi <b><?= $dVoucherAuto['idVoucherAuto'];?></b>|| <a href="<?= base_url('Admin/voucherVirtual')?>">Kembali</a></div>
                            <div class="card-body">
                                <!-- kontek -->
                            <?php 
                            $backColor;
                            $text;
                            if($dVoucherAuto['statusBayar'] === 'N'){
                                $backColor = "red";
                                $text = "New";
                            }else if($dVoucherAuto['statusBayar'] === 'H'){
                                $backColor = "yellow";
                                $text = "Hold";
                            }else if($dVoucherAuto['statusBayar'] === 'D'){
                                $backColor = "#20fc03";
                                $text = "Done";
                            }else if($dVoucherAuto['statusBayar'] === 'E'){
                                $backColor = "black";
                                $text = "Expired";
                            }
                             ?>
                            <div class="card-header" style="background-color: <?= $backColor;?>"><h3>Status : <?= $text;?></h3><small>Created : <?= $dVoucherAuto['dateCreatedAdd'];?></small></div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <table border="1px" cellpadding="5px" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <tbody>
                                            <tr>
                                                <td style="background-color: black;color: white">Nama Lengkap</td>
                                                <td><?= $dVoucherAuto['nama'];?></td>
                                            </tr>
                                             <tr>
                                                <td style="background-color: black;color: white">Handphone</td>
                                                <td><?= $dVoucherAuto['handphone'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Email</td>
                                                <td><?= $dVoucherAuto['email'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Total Voucher</td>
                                                <td><?= $dVoucherAuto['totalVoucher'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Total Bayar</td>
                                                <td><?= "Rp " . number_format($dVoucherAuto['totalBayar'], 2, ",", "."); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Type Transfer</td>
                                                <td><?= $dVoucherAuto['typetransfer'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Virtual Account</td>
                                                <td><?= $dVoucherAuto['virtualAccount'];?></td>
                                            </tr>
                                            <?php if ($dVoucherAuto['typetransfer'] == "qris"){ ?>
                                                 <tr>
                                                <td style="background-color: black;color: white">Scan QR</td>
                                                <td><img src="https://api.midtrans.com/v2/qris/<?= $dVoucherAuto['transaction_id']; ?>/qr-code" style="width:40%"></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td style="background-color: black;color: white"></td>
                                                <td>
                                                    <table border="1px" cellpadding="5px" id="dataTable" width="100%" cellspacing="0">
                                                        <tr style="background-color: black;color: white">
                                                            <td>Kode Voucher</td>
                                                            <td>Nominal</td>
                                                            <td>Status</td>
                                                            <td>Date Created</td>
                                                        </tr>
                                                        <?php foreach ($dVoucherAutoItem as $value) { 
                                                            $backColor1 ="";
                                                            if($value['statusVoucher'] === 'N'){
                                                                $backColor1 = "#20fc03";
                                                                $text = "New";
                                                            }else if($value['statusVoucher'] === 'H'){
                                                                $backColor1 = "yellow";
                                                                $text = "Hold";
                                                            }else if($value['statusVoucher'] === 'D'){
                                                                $backColor1 = "red";
                                                                $text = "Done";
                                                            }else if($value['statusVoucher'] === 'E'){
                                                                $backColor1 = "red";
                                                                $text = "Expired";
                                                            }
                                                        ?>

                                                        <tr>
                                                            <td><?= $value['kodeVoucher'];?></td>
                                                            <td><?= $value['nominalVoucher'];?></td>
                                                            <td style="background-color: <?= $backColor1;?>"><?= $text;?></td>
                                                            <td><?= $value['dateCreatedVoucher'];?></td>
                                                        </tr>
                                                        <?php  } ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>