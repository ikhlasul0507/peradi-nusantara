<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <a href="<?= $previous_url;?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <h6 class="m-0 font-weight-bold text-primary">Data Profile User</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?= base_url('P/Admin/process_edit_user_profile')?>" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap"
                            placeholder="Nama Lengkap" value="<?= $list_data['nama_lengkap'];?>">
                    </div>
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>NIK</label>
                        <input type="number" class="form-control" name="nik"
                            placeholder="NIK" value="<?= $list_data['nik'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email"
                            placeholder="Email" value="<?= $list_data['email'];?>">
                    </div>
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Handphone</label>
                        <input type="number" class="form-control" name="handphone"
                            placeholder="Handphone" value="<?= $list_data['handphone'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <label>KTP</label>
                        <input type="file" class="form-control" accept="image/*" name="foto_ktp"
                            placeholder="foto_ktp" value="<?= $list_data['foto_ktp'];?>">
                        <input type="hidden" class="form-control" name="foto_ktp_lama"
                            placeholder="foto_ktp" value="<?= $list_data['foto_ktp'];?>">
                    </div>
                     <div class="col-sm-3 mb-3 mb-sm-0">
                        <a href="<?= base_url('assets/p/img/'.$list_data['foto_ktp']);?>" target="blank">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; height: 10rem"
                            src="<?= base_url('assets/p/img/'.$list_data['foto_ktp']);?>" alt="...">
                        </a>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <label>PAS FOTO UNTUK KTA</label>
                        <input type="file" class="form-control" accept="image/*"  name="foto_kta"
                            placeholder="foto_kta" value="<?= $list_data['foto_kta'];?>">
                        <input type="hidden" class="form-control" name="foto_kta_lama"
                            placeholder="foto_kta" value="<?= $list_data['foto_kta'];?>">
                    </div>
                     <div class="col-sm-3 mb-3 mb-sm-0">
                        <a href="<?= base_url('assets/p/kta/'.$list_data['foto_kta']);?>" target="blank">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; height: 10rem"
                            src="<?= base_url('assets/p/kta/'.$list_data['foto_kta']);?>" alt="...">
                        </a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Perbaharui Data</button>
            </form>
        </div>
    </div>

</div>