         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php  endif; ?>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Virtual Voucher</div>
                    <div class="card-body">
                        <!-- kontek -->
                        <div class="dropdown">
                            <form action="" method="get">
                                <input type="text" name="namaHp" placeholder="Nama/Handphone...">
                                <input type="date" name="tanggal" id="tanggalCari" placeholder="Nama/Handphone...">
                                <select onchange="" style="height: 30px"  name="typetransfer">
                                    <option value="">All Type</option>
                                    <option value="N" style="background-color: red">New</option>
                                    <option value="H" style="background-color: yellow">Hold</option>
                                    <option value="D" style="background-color: green">Done</option>
                                    <option value="E" style="background-color: black;color: white">Expire</option>
                                </select>
                                <button type="submit">Cari</button>
                                <button type="submit" onclick="setDate('yesterday')">Yesterday</button>
                                <button type="submit" onclick="setDate('today')">Today</button>
                                <a href="<?= base_url('Admin/tambahKriteria');?>" class="float-right">-Export Excel-</a>
                            </form>
                        </div>

                <div class="table-responsive mt-3">
                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                        <table border="1px" width="100%" cellspacing="0">

                            <thead>
                                <tr style="background-color: black;color: white">
                                    <td>ID</td>
                                    <td>Nama</td>
                                    <td>Handpone</td>
                                    <td>Email</td>
                                    <td>Type Transfer</td>
                                    <td>Bukti Transfer</td>
                                    <td>Total Bayar</td>
                                    <td>Total Voucher</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                    <td>Tanggal</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                $totalVoucher = 0;
                                $stN = 0;
                                $stH = 0;
                                $stD = 0;
                                $stE = 0;
                                foreach ($voucherManual as $p):
                                    $backColor;
                                    if($p['statusBayar'] === 'N'){
                                        $backColor = "red";
                                    }else if($p['statusBayar'] === 'H'){
                                        $backColor = "yellow";
                                    }else if($p['statusBayar'] === 'D'){
                                        $backColor = "#20fc03";
                                    }else if($p['statusBayar'] === 'E'){
                                        $backColor = "black";
                                    }
                                ?>
                                    <tr>
                                        <td> <a href="<?= base_url('Admin/detailVoucherManual/'.$p['idVoucherManual']) ?>"><?= $p['idVoucherManual'];?></a></td>
                                        <td><?= $p['nama'];?></td>
                                        <td><?= $p['handphone'];?></td>
                                        <td><?= $p['email'];?></td>
                                        <td><?= $p['typetransfer'];?></td>
                                        <td>
                                            <a href="<?= base_url('assets/img/sellingVoucher/').$p['uploadBuktiBayar']?>" target="_blank">Lihat
                                                <!-- <img src="<?= base_url('assets/ump/assets/buyvc/').$p['uploadBuktiBayar']?>" style="width: 100px;height: 100px"> -->
                                            </a>
                                            ||
                                            <?php if($p['statusBayar'] === 'N'){ ?>
                                                <a href="<?= base_url('Admin/verifySellingVoucherManual/'.$p['idVoucherManual']);?>">Verify</a>
                                            <?php } ?>
                                        </td>
                                        <td><b><?= "Rp " . number_format($p['totalBayar'], 2, ",", "."); ?></b></td>    
                                        <td><?= $p['totalVoucher'];?></td>    
                                        <td style="background-color: <?= $backColor;?>"><b><?= $p['statusBayar'];?></b></td>    
                                        <td> 
                                            <a href="<?= base_url('Admin/h_voucherManual/'.$p['idVoucherManual']) ?>" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
                                        </td>
                                        <td><?= $p['dateCreatedAdd'];?></td>
                                    </tr>

                                <?php 
                                $total += $p['totalBayar'];
                                $totalVoucher += $p['totalVoucher'];
                                if($p['statusBayar'] == 'N'){
                                    $stN = $stN +1;
                                }else if($p['statusBayar'] == 'H'){
                                    $stH = $stH +1;
                                }else if($p['statusBayar'] == 'D'){
                                    $stD = $stD +1;
                                }else if($p['statusBayar'] == 'E'){
                                    $stE = $stE +1;
                                }
                                endforeach; ?>
                                     <tr style="background-color: black;color: white">  
                                        <td colspan="6">Total</td>
                                        <td><b><?="Rp. " . number_format($total, 2, ",", "."); ?></b></td>
                                        <td><?= $totalVoucher;?></td>
                                        <td colspan="3">Status : N = (<?=$stN;?>) || H = (<?=$stH;?>) || D = (<?=$stD;?>) || E = (<?=$stE;?>)</td>
                                    </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    function setDate($type){
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var day = date.getDate();
        if ($type === 'today') {
            document.getElementById('tanggalCari').value = year + "-" + month + "-" + day;
        }else if ($type === 'yesterday') {
            day = date.getDate()-1;
            document.getElementById('tanggalCari').value = year + "-" + month + "-" + day;
        }
    }
</script>

<style type="text/css">
    @media (max-width: 520px) {
        input[name="namaHp"] {
            width: 100%;
            margin-bottom: 5px
        }
        input[name="tanggal"] {
            width: 100%;
            margin-bottom: 5px
        }
        select[name="typetransfer"] {
            width: 100%;
            margin-bottom: 5px
        }
    }
</style>