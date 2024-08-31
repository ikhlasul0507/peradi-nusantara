         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data Kriteria</li>
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
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Kriteria</div>
                    <div class="card-body">
                        <!-- kontek -->
                         <a href="<?= base_url('Admin/tambahKriteria');?>" class="btn btn-danger mb-4">Tambah Kriteria</a>
                        <div class="dropdown">
                </div>

                <div class="table-responsive">
                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                        <table border="1px" width="100%" cellspacing="0">

                            <thead>
                                <tr style="background-color: black;color: white">
                                    <td>ID</td>
                                    <td>Nama Kriteria</td>
                                    <td>Bobot Kriteria</td>
                                    <td>Jenis Kriteria</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                foreach ($dumpKriteria as $p):?>
                                    <tr>
                                        <td><?= $p['idKriteria'];?></td>
                                        <td><?= $p['namaKriteria'];?></td>    
                                        <td><?= $p['bobot'];?></td>    
                                        <td><b><?= $p['namaJenis'];?></b></td>    
                                        <td> 
                                            <a href="<?= base_url('Admin/e_Kriteria/'.$p['idKriteria']) ?>">Edit</a> || 
                                            <a href="<?= base_url('Admin/h_Kriteria/'.$p['idKriteria']) ?>" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
                                        </td>
                                    </tr>

                                <?php 
                                $total += $p['bobot'];
                                endforeach; ?>
                                <tr>  
                                        <td colspan="5"><b>Total Bobot Harus Bernilai : <?= $total;?></b></td>    
                                    </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>