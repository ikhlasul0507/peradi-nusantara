         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Hasil Pembelian Voucher</li>
                        </ol>
                        <?php 
                        $a = $this->db->query("SELECT SUM(nv) AS total FROM tbl_bv")->result_array();

                         ?>
                        <b><h6>Total Dana Pembelian Voucher :<b>Rp.<?= number_format($a[0]['total'], 0, ',', '.')  ?></b></h6></b>
                        <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php  endif; ?>
                
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Pembelian Voucher</div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr style="background-color: blue">
                                                <td>Nama Lengkap</td>
                                                <td>Whatsapp</td>
                                                <td>Tanggal</td>
                                                <td>Nominal</td>
                                                <td>Bukti Transfer</td>
                                                <td>Status</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($vc as $p):?>
                                            <tr>
                                                <td><?= $p['nm'];?></td>
                                                <td><?= $p['wa'];?></td>
                                                <td><?= $p['tgl'];?></td>
                                                <td>
                                                    <?= "Rp. ". number_format($p['nv'], 0, ',', '.')  ?></td>
                                                <td>
                                                    <a href="<?= base_url('assets/img/bv/').$p['ubp']?>" target="_blank"><img src="<?= base_url('assets/img/bv/').$p['ubp']?>" style="width: 100px;height: 100px"></a>
                                                    </td>
                                                <td>
                                                    <?php 
                                                    $id_bv = $p['id_bv'];
                                                    $kvc= $this->db->get_where('tbl_vc', ['id_bv' => $id_bv])->row_array(); 

                                                    if($kvc){
                                                    ?>

                                                    <a class="badge badge-success" target="_blank" href="<?= base_url('Admin/bkv/'.$p['id_bv']) ?>">Lihat Voucher</a>
                                                    <?php }else{ 
                                                        echo "Voucher Sudah Di Gunakan";
                                                    } ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>