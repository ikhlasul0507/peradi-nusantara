         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data Jenis Kriteria</li>
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
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Jenis Kriteria</div>
                    <div class="card-body">
                        <!-- kontek -->
                         <a href="<?= base_url('Admin/tambahJenisKriteria');?>" class="btn btn-danger mb-4">Tambah Jenis Kriteria</a>
                        <div class="dropdown">
                </div>

                <div class="table-responsive">
                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                        <table border="1px" width="100%" cellspacing="0">

                            <thead>
                                <tr style="background-color: black;color: white">
                                    <td>ID</td>
                                    <td>Nama Jenis Kriteria</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dumpJenisKriteria as $p):?>
                                    <tr>
                                        <td><?= $p['idJenis'];?></td>
                                        <td><?= $p['namaJenis'];?></td>    
                                        <td> 
                                            <a href="<?= base_url('Admin/e_JenisKriteria/'.$p['idJenis']) ?>" >Edit</a> || 
                                            <a href="<?= base_url('Admin/h_jenisKriteria/'.$p['idJenis']) ?>" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
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