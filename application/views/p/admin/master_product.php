<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Kelas</h6>
             <a href="<?= base_url('P/Admin/add_master_product/');?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama Kelas</th>
                            <th>Metode Bayar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama Kelas</th>
                            <th>Metode Bayar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list_data as $value) { ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('P/Admin/edit_master_product/'.$value['id_master_kelas']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('P/Admin/detail_master_product/'.$value['id_master_kelas']);?>" class="btn btn-info btn-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Admin/delete_master_product/').$value['id_master_kelas'];?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td>
                                <button class="badge badge-info"><?= $value['is_active'] == 'Y' ? 'Aktif' : 'Tidak Aktif';?></button><br>
                                <?= $value['nama_kelas'];?></td>
                            <td><?= $value['metode_bayar'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
