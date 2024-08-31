<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Master Parameter</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama</th>
                            <th>Value</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Aksi</th>
                            <th>Nama</th>
                            <th>Value</th>
                            <th>Type</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list_data as $value) { 
                            if($value['nama_parameter'] == "lockLoginForEveryOne" && $this->session->userdata('user_level') > 1) continue;
                        ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('P/Admin/edit_parameter/'.$value['id_parameter']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Admin/delete_parameter/').$value['id_parameter'];?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $value['nama_parameter'];?></td>
                            <td><?= $value['value_parameter'];?></td>
                            <td> <button class="badge badge-danger"><?= $value['type_parameter'] == 'O' ? 'Options' : 'Text';?></button><br></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
