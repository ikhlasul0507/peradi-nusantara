         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Hasil Pembelian Voucher</li>
                        </ol>
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
                                                <td>
                                                    <a target="_blank" class="btn btn-success" href="https://api.whatsapp.com/send?phone=62<?= $p['wa'];?>&text=Halo%20<?= $p['nmv'];?>,%20Terima%20Kasih%20 telah%20 Membeli%20 Voucher%20 Bujang %20Gadis%20 POLSRI,%20Voucher%20 Anda %20Adalah %20: %20%20<?= $p['kv'];?>%20%20, %20Atau%20Silahkan%20 Scan %20Kode%20 Berikut%20 Untuk%20 Melihat%20 Voucher.%20^-^">Chat Wa Kirim Voucher<i class="fa fa-whatsapp ml-1"></i></a><br>
                                                    <?= $p['wa'];?></td>
                                                <td><?= $p['tgl'];?></td>
                                                <td><?= "Rp. ". number_format($p['nv'], 0, ',', '.')  ?></td>
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