         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                     <div class="card mb-4 mt-3">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Pembelian Voucher</div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                                    <?php foreach ($vc as $p):?>
                                    <table class="table table-bordered" width="100%" cellspacing="0"> 
                                        <thead>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td><?= $p['nm'];?></td>
                                            <tr>
                                                <td>Whatsapp</td>
                                                <td><?= $p['wa'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Pembelian</td>
                                                <td><?= $p['tgl'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Nominal</td>
                                                <td><?= $p['nv']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bukti Transfer</td>
                                                <td><a href="<?= base_url('assets/img/bv/').$p['ubp']?>" target="_blank"><img src="<?= base_url('assets/img/bv/').$p['ubp']?>" style="width: 100px;height: 100px"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a class="btn btn-primary" href="<?= base_url('Admin/vdvc/'.$p['id_bv'])?>">Verifikasi</a></td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <?php endforeach; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>