<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <a href="<?= $previous_url;?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <h6 class="m-0 font-weight-bold text-primary">Data Profile User</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?= base_url('P/Admin/process_edit_user_profile')?>" method="post" enctype="multipart/form-data">
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
                <button type="submit" class="btn btn-primary">Perbaharui Data</button>
            </form>
        </div>
    </div>

</div>