         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Edit Data Parameter</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Edit Data Parameter</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/pe_parameter'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="idParameter" value="<?= $ejr['idParameter'];?>">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12">
                                            <label>Nama Parameter</label>
                                            <input type="hidden" name="namaParameter" value="<?= $ejr['namaParameter'];?>" placeholder="Nama Menu" class="form form-control">
                                            <input type="text" value="<?= $ejr['namaParameter'];?>" placeholder="Nama Menu" class="form form-control" disabled>
                                        </div>
                                        <?php if($ejr['typeParameter'] === "T"){ ?>
                                        <div class="col-12">
                                            <label>Value Parameter</label><br>
                                            <input type="text"  name="valueParameter" value="<?= $ejr['valueParameter'];?>" placeholder="value Parameter" class="form form-control">
                                        </div>
                                        <?php }else{ ?>
                                            <div class="col-12">
                                            <label>Value Parameter</label><br>
                                            <small>0 = Tidak Aktif, 1 = Aktif</small>
                                            <select name="valueParameter" value="<?= $ejr['valueParameter'];?>" class="form form-control">
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                            </div>
                                        <?php } ?>
                                       
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-3">Edit</button>
                                            <a href="<?= base_url('admin/Parameter')?>" class="btn btn-danger mt-3 ml-2">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>