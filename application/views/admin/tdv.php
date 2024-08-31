         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Tambah Data Peserta Voting</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Tambah Data Peserta Voting</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_dpv'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12">
                                            <label>Nama Peserta</label>
                                            <input type="text" name="nm_v" placeholder="Nama Peserta" class="form form-control">
                                            <input type="hidden" name="jr_v" value="72">
                                        </div>
                                        <!-- <div class="col-12 mt-2">
                                            <label>Jurusan</label>
                                            <select class="form-control" name="jr_v">
                                                <option selected disabled>Jurusan/Prodi</option>
                                                <?php foreach ($jr as $j):?>
                                                <option value="<?= $j['nm_jur'];?>"><?= $j['nm_jur'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div> -->
                                        <div class="col-12 mt-2">
                                            <label>Photo Peserta</label>
                                            <input type="file" name="ph_v" placeholder="" class="form form-control">
                                             <small>*note : </small>
                                            <small>*jika tidak di ganti biarkan saja</small>
                                            <small>*nama file tidak boleh ada spasi</small>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label>No Peserta</label>
                                            <input type="number" name="np_v" placeholder="Nomor Peserta" class="form form-control">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jk">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="1">Laki-Laki</option>
                                                <option value="2">Perempuan</option>
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