         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Data Menu</li>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Menu</div>
                            <div class="card-body">
                                <!-- kontek -->
                                <a href="<?= base_url('Admin/tMenuKontrol');?>" class="btn btn-danger mb-4">Tambah Menu</a>
                                <!-- <a href="<?= base_url('Admin/rdv');?>" class="btn btn-info mb-4">Reset Peserta Voting</a> -->
                                <div class="table-responsive">
                                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr>
                                                <td>Jenis Menu</td>
                                                <td>Nama Menu</td>
                                                <td>Url Menu</td>
                                                <td>Status</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                             $usersData = $this->db->query("SELECT * FROM tbl_menu ORDER BY idMenu ASC" )->result_array();
                                            foreach ($usersData as $p):?>
                                            <tr>
                                                <td><?php if($p['jenisMenu']==1)
                                                {
                                                    echo "SPK";
                                                }else if($p['jenisMenu']==2){
                                                    echo "Voting";
                                                }else{
                                                    echo "Report";
                                                }
                                                ;?>
                                                    
                                                </td>
                                                <td><?= $p['namaMenu']; ?></td>
                                                <td><?= $p['urlMenu']; ?></td>
                                                <td>
                                                    <?php if ($p['isActive']==1) {
                                                        echo "<p class='badge badge-info'>Aktif</p>";
                                                    } else {
                                                        echo "<p class='badge badge-warning'>Tidak Aktif</p>";
                                                    }
                                                     ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('Admin/eMenuKontrol/'.$p['idMenu']) ?>" class="btn btn-primary">Edit</a>
                                                    <a href="<?= base_url('Admin/hMenuKontrol/'.$p['idMenu']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
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