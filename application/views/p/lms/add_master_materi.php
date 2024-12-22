<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Materi Kelas</h6>
             <a href="<?= base_url('P/Admin/master_product');?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form class="user" action="<?= base_url('P/Lms/process_add_master_materi')?>" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <small>Pilih Kelas</small>
                        <select class="form-control" required name="id_master_kelas" value="<?= $id_master_kelas;?>">
                            <option value="" selected class="placeholder">--Pilih Kelas--</option>
                            <?php foreach ($list_master_kelas as $lms) { ?>
                            <?php if($id_master_kelas == $lms['id_master_kelas']){ ?>
                                <option selected value="<?= $lms['id_master_kelas'];?>"><?= $lms['nama_kelas'];?></option>
                            <?php }else{ ?>
                                <option value="<?= $lms['id_master_kelas'];?>"><?= $lms['nama_kelas'];?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <small>Pilih Angkatan</small>
                        <select class="form-control" required name="angkatan">
                                <option value="" disabled selected>--Pilih Angkatan--</option>
                                <?php for ($i= $startAngkatan; $i <= $endAngkatan; $i++) {?>
                                    <option value="<?=$i;?>">Angkatan Ke - <?=$i;?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <small>Tanggal Pelaksanaan</small>
                        <input class="form-control form-control" name="date_field" placeholder="Link Zoom" required type="date" id="date_field">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <small>Waktu Pelaksanaan</small>
                        <input class="form-control form-control" name="waktu" placeholder="Link Zoom" required type="time" id="waktu">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Link Video Youtube" name="dokument_video" style="height: 200px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="formFileLg" class="form-label">Upload  Materi Kelas</label>
                        <small>(Format file : PDF, Docx, Pptx)</small>
                        <input class="form-control form-control-lg" name="dokument_materi" required type="file" id="fileInput" accept=".pdf,.docx,.pptx">
                    </div>
                    <div class="col-sm-3">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" id="" style="width: 25rem;"
                            src="<?= base_url('assets/p/sistem/');?>img/undraw_posting_photo.svg" alt="...">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input class="form-control form-control" name="link_zoom" placeholder="Link Zoom" required type="text" id="fileInput">
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

</div>