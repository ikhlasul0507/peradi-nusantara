         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Tambah Data Kriteria</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Kriteria</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_Kriteria'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-6">
                                            <label>Nama Kriteria</label>
                                            <input type="text" name="namaKriteria" placeholder="Nama Kriteria" required class="form form-control">
                                        </div>
                                        <div class="col-6">
                                            <label>Bobot Kriteria</label>
                                            <input type="text" name="bobot" placeholder="Bobot Kriteria" required class="form form-control">
                                        </div>
                                        <div class="col-6">
                                            <label>Jenis Kriteria</label>
                                            <select class="form-control" name="idJenis" required>
                                                <option selected value="" disabled>--Pilih--</option>
                                                <?php foreach ($dumpJenisKriteria as $key) { ?>
                                                <option value="<?= $key['idJenis'];?>"><?= $key['namaJenis'];?></option>
                                                <?php } ?>
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