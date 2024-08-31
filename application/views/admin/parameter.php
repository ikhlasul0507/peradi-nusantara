         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data  Parameter</li>
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
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Parameter</div>
                    <div class="card-body">
                        <!-- kontek -->
                        <a href="<?= base_url('Admin/t_paramater');?>" class="btn btn-danger mb-4">Tambah Parameter</a>
                        <div class="dropdown">
                    

                </div>

                <div class="table-responsive">
                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <td>Nama Parameter</td>
                                    <td>Value</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 $usersData = $this->db->query("SELECT * FROM tbl_parameter ORDER BY idParameter ASC" )->result_array();
                                foreach ($usersData as $p):?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="idParameter" value="<?= $p['idParameter'];?>">
                                            <?= $p['namaParameter'];?>
                                            </td>
                                         <td>

                                            <?php 
                                            if($p['valueParameter'] != ""){
                                                if($p['valueParameter'] == 0 && is_numeric($p['valueParameter']) == true){
                                                echo "Tidak Aktif";
                                                 }else if($p['valueParameter'] == 1 && is_numeric($p['valueParameter']) == true){
                                                    echo "Aktif";
                                                 }else if($p['valueParameter'] != ""){
                                                    echo $p['valueParameter'];
                                                 }
                                                // echo $p['valueParameter'];
                                            }?>
                                            </td>   
                                        <td>
                                            <a href="<?= base_url('Admin/eParameter/'.$p['idParameter'])?>" class="btn btn-warning">Edit</a>
                                                <a href="<?= base_url('Admin/h_parameter/'.$p['idParameter']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
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