<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Parameter</h6>
             <a href="<?= base_url('P/Admin/parameter');?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form class="user" action="<?= base_url('P/Admin/process_edit_parameter')?>" method="post">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <input type="hidden" name="id_parameter" value="<?= $list_data['id_parameter'];?>">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" required name="nama_parameter"
                            placeholder="Nama Kelas" value="<?= $list_data['nama_parameter'];?>">
                    </div>
                    <?php if($list_data['type_parameter'] == 'O'){ ?>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <select class="form-control" name="value_parameter" required value="<?= $list_data['value_parameter'];?>">
                                <option value="" disabled selected class="placeholder">--Pilih status kelas--</option>
                                <option value="Y" <?php echo ($list_data['value_parameter'] == 'Y') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="N" <?php echo ($list_data['value_parameter'] == 'N') ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                             <input type="text" class="form-control"  required name="value_parameter"
                                placeholder="" value="<?= $list_data['value_parameter'];?>">
                        </div>
                    <?php } ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

</div>