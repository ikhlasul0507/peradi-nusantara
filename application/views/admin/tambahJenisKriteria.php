         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Tambah Data Jenis Kriteria</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Jenis Kriteria</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_jenisKriteria'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-6">
                                            <label>Nama Jenis Kriteria</label>
                                            <input type="text" name="namaJenis" placeholder="Nama Jenis Kriteria" required class="form form-control">
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                            <button type="reset" class="btn btn-danger mt-3 ml-2">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>