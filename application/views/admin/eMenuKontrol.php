         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Edit Data Peserta Voting</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Edit Data Peserta Voting</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/pe_menuKontrol'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="idMenu" value="<?= $ejr['idMenu'];?>">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12">
                                            <label>Nama Menu</label>
                                            <input type="text" name="namaMenu" value="<?= $ejr['namaMenu'];?>" placeholder="Nama Menu" class="form form-control">
                                        </div>
                                        <div class="col-12">
                                            <label>Url Menu</label>
                                            <input type="text" name="urlMenu" value="<?= $ejr['urlMenu'];?>" placeholder="Url Menu" class="form form-control">
                                        </div>
                                       
                                        <div class="col-12 mt-2">
                                            <label>Status Menu</label>
                                            <select class="form-control" name="isActive">
                                                <?php if($ejr['isActive'] == 1){?>
                                                <option value="1" selected>Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                                <?php }else{?>
                                                <option value="1" >Aktif</option>
                                                <option value="0" selected>Tidak Aktif</option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label>Jenis Menu</label>
                                            <select class="form-control" name="jenisMenu">
                                                <?php if($ejr['jenisMenu'] == 1){?>
                                                <option value="1" selected>SPK</option>
                                                <option value="2">Voting</option>
                                                <option value="3">Report Voting</option>
                                                <?php }else if($ejr['jenisMenu'] == 1){?>
                                                <option value="1">SPK</option>
                                                <option value="2" selected>Voting</option>
                                                <option value="3">Report Voting</option>
                                                <?php }else{?>
                                                <option value="1">SPK</option>
                                                <option value="2">Voting</option>
                                                <option value="3" selected>Report Voting</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-3">Edit</button>
                                            <a href="<?= base_url('admin/menuKontrol')?>" class="btn btn-danger mt-3 ml-2">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>