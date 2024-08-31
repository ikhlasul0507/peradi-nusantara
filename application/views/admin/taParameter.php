         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Tambah Data Parameter</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Parameter</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_taParameter'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-6">
                                            <label>Nama Parameter</label>
                                            <input type="namaParameter" name="namaParameter" placeholder="namaParameter" class="form form-control">
                                        </div>
                                        <div class="col-6">
                                            <label>Value Parameter</label>
                                            <input type="valueParameter" name="valueParameter" placeholder="valueParameter" class="form form-control">
                                        </div>
                                        <div class="col-6">
                                            <label>Tpye Parameter</label>
                                            <select class="form form-control" name="typeParameter" required>
                                                <option value="">-Pilih Type-</option>
                                                <option value="T">Text</option>
                                                <option value="O">Options</option>
                                            </select>
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