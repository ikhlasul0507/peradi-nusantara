<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Detail Master Data Kelas</h6>
             <a href="<?= base_url('P/Admin/master_product');?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form class="user" action="<?= base_url('P/Admin/process_add_master_product')?>" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="nama_kelas"
                            placeholder="Nama Kelas" value="<?= $list_data['nama_kelas'];?>" disabled>
                    </div>

                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" disabled name="is_active" value="<?= $list_data['is_active'];?>">
                            <option value="Y" <?php echo ($list_data['is_active'] == 'Y') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="N" <?php echo ($list_data['is_active'] == 'N') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" disabled name="is_sumpah" value="<?= $list_data['is_sumpah'];?>">
                            <option value="Y" <?php echo ($list_data['is_sumpah'] == 'Y') ? 'selected' : ''; ?>>Ya</option>
                            <option value="N" <?php echo ($list_data['is_sumpah'] == 'N') ? 'selected' : ''; ?>>Tidak</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                         <input type="text" class="form-control"  required name="metode_bayar"
                            disabled value="<?= $list_data['metode_bayar'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Deskripsi Kelas" disabled name="deskripsi_kelas" style="height: 200px"><?= $list_data['deskripsi_kelas'];?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                         <input type="text" class="form-control"  required name="prefix_certificate"
                            disabled value="<?= $list_data['prefix_certificate'];?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                         <input type="text" class="form-control"  required name="link_group_wa"
                            disabled value="<?= $list_data['link_group_wa'];?>">
                    </div>
                    <div class="col-sm-3">
                        <img class="img-fluid px-3 px-sm-4 mt-1 mb-2" id="imagePreview" style="width: 25rem;"
                            src="<?= base_url('assets/p/img/'.$list_data['foto_kelas']);?>" alt="...">
                    </div>
                    <div class="col-sm-3">
                        <img class="img-fluid px-3 px-sm-4 mt-1 mb-2" id="imagePreview" style="width: 25rem;"
                            src="<?= base_url('assets/p/img/'.$list_data['foto_sertifikat']);?>" alt="...">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>