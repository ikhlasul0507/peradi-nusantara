         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Detail Voucher Auto</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>ID Transaksi <b><?= $dVoucherManual['idVoucherManual'];?></b>|| <a href="<?= base_url('Admin/voucherVirtual')?>">Kembali</a></div>
                            <div class="card-body">
                                <!-- kontek -->
                            <?php 
                            $backColor;
                            $text;
                            if($dVoucherManual['statusBayar'] === 'N'){
                                $backColor = "red";
                                $text = "New";
                            }else if($dVoucherManual['statusBayar'] === 'H'){
                                $backColor = "yellow";
                                $text = "Hold";
                            }else if($dVoucherManual['statusBayar'] === 'D'){
                                $backColor = "#20fc03";
                                $text = "Done";
                            }else if($dVoucherManual['statusBayar'] === 'E'){
                                $backColor = "black";
                                $text = "Expired";
                            }
                             ?>
                            <div class="card-header" style="background-color: <?= $backColor;?>"><h3>Status : <?= $text;?></h3><small>Created : <?= $dVoucherManual['dateCreatedAdd'];?></small></div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <table border="1px" cellpadding="5px" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <tbody>
                                            <tr>
                                                <td style="background-color: black;color: white">Nama Lengkap</td>
                                                <td><?= $dVoucherManual['nama'];?></td>
                                            </tr>
                                             <tr>
                                                <td style="background-color: black;color: white">Handphone</td>
                                                <td><?= $dVoucherManual['handphone'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Email</td>
                                                <td><?= $dVoucherManual['email'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Total Voucher</td>
                                                <td><?= $dVoucherManual['totalVoucher'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Total Bayar</td>
                                                <td><?= "Rp " . number_format($dVoucherManual['totalBayar'], 2, ",", "."); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Type Transfer</td>
                                                <td><?= $dVoucherManual['typetransfer'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: black;color: white">Bukti</td>
                                                <td>
                                                    <a href="<?= base_url('assets/img/sellingVoucher/').$dVoucherManual['uploadBuktiBayar']?>" target="_blank">
                                                    <img src="<?= base_url('assets/img/sellingVoucher/').$dVoucherManual['uploadBuktiBayar']?>" style="width: 400px;height: 200px">
                                            </a>
                                                </td>
                                            </tr>
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
                                                        <?php foreach ($dVoucherManualItem as $value) { 
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