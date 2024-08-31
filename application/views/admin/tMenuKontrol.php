         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Tambah Data Menu</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Tambah Data Menu</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_MenuKontrol'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12">
                                            <label>Nama Menu</label>
                                            <input type="text" name="namaMenu" placeholder="Nama Menu" class="form form-control">
                                        </div>
                                        <div class="col-12">
                                            <label>Url Menu</label>
                                            <input type="text" name="urlMenu" placeholder="Nama Menu" class="form form-control">
                                        </div>
                                        
                                        <div class="col-12 mt-2">
                                            <label>Status Menu</label>
                                            <select class="form-control" name="isActive">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label>Jenis Menu</label>
                                            <select class="form-control" name="jenisMenu">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="1">SPK</option>
                                                <option value="2">Voting</option>
                                                <option value="3">Report Voting</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                            <button type="reset" class="btn btn-danger mt-3 ml-2">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>