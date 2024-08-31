         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Hasil Voucher</li>
                        </ol>
                        <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php  endif; ?>
                    
                        <?php
                            $a = $this->db->query("SELECT * FROM tbl_set")->row_array();
                            $re = $a['set_voting'];
                            if($re==1){
                           ?>
                           <b>Voucher Sedang Di Buka</b><br>
                            <a href="<?= base_url('Admin/v_s');?>" class="btn btn-success mb-3 ml-3" >Tutup</a>
                       <?php }else{ ?>
                            <b>Voucher Sedang Di Tutup</b><br>
                            <a href="<?= base_url('Admin/v_o');?>" class="btn btn-success mb-3 ml-3" >Buka</a>
                       <?php } ?>
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
                                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=62<?= $p['wa'];?>">Chat Wa<i class="fa fa-whatsapp ml-1"></i></a><br>
                                                    <?= $p['wa'];?></td>
                                                <td><?= $p['tgl'];?></td>
                                                <td><?= "Rp. ". number_format($p['nv'], 0, ',', '.')  ?></td>
                                                <td>
                                                    <a href="<?= base_url('assets/img/bv/').$p['ubp']?>" target="_blank"><img src="<?= base_url('assets/img/bv/').$p['ubp']?>" style="width: 100px;height: 100px"></a>
                                                    </td>
                                                <td>
                                                    <?php if($p['st']==0){ ?>
                                                    <a class="badge badge-warning" href="<?= base_url('Admin/stv/'.$p['id_bv']) ?>">Verifikasi</a>
                                                <?php }else{ ?>
                                                    <a class="badge badge-success" href="<?= base_url('Admin/stv/'.$p['id_bv']) ?>">Lihat Voucher</a>
                                               <?php  } ?>
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