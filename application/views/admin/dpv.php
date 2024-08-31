         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Data Peserta Voting</li>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data User</div>
                            <div class="card-body">
                                <!-- kontek -->
                                <a href="<?= base_url('Admin/tdv');?>" class="btn btn-danger mb-4">Tambah Peserta Voting</a>
                                <!-- <a href="<?= base_url('Admin/rdv');?>" class="btn btn-info mb-4">Reset Peserta Voting</a> -->
                                <div class="table-responsive">
                                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                                     <table id="dataTable" border="1px" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr>
                                                <td>ID Voting</td>
                                                <td>Nama Peserta</td>
                                                <td>Photo Peserta</td>
                                                <td>Nomor Peserta</td>
                                                <td>Jenis Kelamin</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dp as $p):?>
                                            <tr>
                                                <td><?= $p['id_dpv'];?></td>
                                                <td><?= $p['nm_v']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('assets/img/dpv/').$p['ph_v']?>" target="_blank"><img src="<?= base_url('assets/img/dpv/').$p['ph_v']?>" style="width: 100px;height: 100px"></a>
                                                </td>
                                                <td><?= $p['np_v']; ?></td>
                                                <td>
                                                    <?php if ($p['jk_v']==1) {
                                                        echo "<p class='badge badge-info'>Laki-Laki</p>";
                                                    } else {
                                                        echo "<p class='badge badge-warning'>Perempuan</p>";
                                                    }
                                                     ?>
                                                </td>
                                                <td align="center" valign="middle">
                                                    <a href="<?= base_url('Admin/edpv/'.$p['id_dpv']) ?>" class="btn btn-primary">Edit</a>
                                                    <a href="<?= base_url('Admin/hdpv/'.$p['id_dpv']) ?>" class="btn btn-danger mt-1" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
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