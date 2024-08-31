         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Hasil Tes Online</li>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Hasil TES ONLINE</div>
                            <div class="card-body">
                                <!-- kontek -->
                                <div class="table-responsive">
                                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr style="background-color: blue">
                                                <td>Nama Lengkap</td>
                                                <td>Aksi</td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ps as $p):?>
                                            <tr>
                                                <td><?= $p['_nm_p'];?></td>
                                                <td><a href="<?= base_url('Admin/uu/'.$p['id_p']);?>" class="badge badge-warning">Ujian Ulang</a></td>
                                                
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