         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Edit Data Jenis Kriteria</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Edit Data Jenis Kriteria</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/pe_jenisKriteria'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="idJenis" value="<?= $ejr['idJenis'];?>">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12">
                                            <label>Nama Jenis Kriteria</label>
                                            <input type="text" name="namaJenis" value="<?= $ejr['namaJenis'];?>" placeholder="Nama Jenis" class="form form-control">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-3">Edit</button>
                                            <a href="<?= base_url('admin/dataJenisKriteria')?>" class="btn btn-danger mt-3 ml-2">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>