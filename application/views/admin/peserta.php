         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Pendaftaran Peserta</li>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Pendaftaran</div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr style="background-color: black;color: white">
                                                <td>Nama Lengkap</td>
                                                <td>Jurusan</td>
                                                <td>Semester (Kelas)</td>
                                                <td>HP</td>
                                                <td>Email</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ps as $p):?>
                                            <tr>
                                                <td><?= $p['_nm_p'];?></td>
                                                <td><?= $p['nm_jur']; ?></td>
                                                <td><?= $p['_s_p'];?></td>
                                                <td><?= $p['_hp'];?></td>
                                                <td><?= $p['_email'];?></td>
                                                <td><?php 
                                                        $b = $p['id_p'];
                                                        $a = $this->db->get_where('tbl_byr',['id_pb'=>$b])->row_array();
                                                        if($a){?>
                                                    <a href="<?= base_url('Admin/lihat/'.$p['id_p']) ?>" class="btn btn-info">Verifikasi</a>
                                                <?php } ?>
                                                    <a href="<?= base_url('Admin/hp/'.$p['id_p']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
                                                    <?php 
                                                        $b = $p['id_p'];
                                                        $a = $this->db->get_where('tbl_byr',['id_pb'=>$b])->row_array();
                                                        if($a){?>
                                                            <p class="badge badge-success">Telah Upload Berkas</p>
                                                    <?php }else{ ?>
                                                        <p class="badge badge-warning">Belum Upload Berkas</p>
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