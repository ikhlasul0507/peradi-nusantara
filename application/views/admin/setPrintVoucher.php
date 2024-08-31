         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Set Data Cetak Voucher</li>
                    </ol>

            <?php
            if($activePrintVoucher==1){
             ?>
              <a href="<?= base_url('Admin/cvc');?>" class="btn btn-primary mb-3" target="_blank">Print Voucher</a>
            <small>* Tambahkan Nominal Dibelakang url, untuk semua tanpa nominal, contoh : Admin/cvc/100000</small>
           <?php }?>
                    <div class="card mb-4 mt-3">
                        <div class="card-header"><i class="fas fa-table mr-1"></i>Data Voucher</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                   <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_setPrintVoucher'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12 mt-2">
                                            <label>Photo Desain Voucher</label>
                                            <input type="file" name="photoVoucher" placeholder="" class="form form-control">
                                            <small>*note : </small>
                                            <small>*Harus Masukan Photo</small>
                                        </div>
                                         <div class="col-12 mt-2">
                                             <label for="exampleFormControlSelect1">Pilih Nominal</label>
                                             <select class="form-control" id="exampleFormControlSelect1" name="nominalVoucher">
                                              <option selected disabled>Pilih Nominal</option>
                                               <?php
                                                $arrayString= explode(",", $optionsNominalVoucher);
                                                for ($i=0; $i <  count($arrayString); $i++) {?>
                                                  <option value="<?= $arrayString[$i];?>"><?="Rp. ". number_format($arrayString[$i], 0, ',', '.');?></option>
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
                            <div class="col-md-8">
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <td>ID Desain Voucher</td>
                                                    <td>Voucher Nominal</td>
                                                    <td>Photo Voucher</td>
                                                    <td>Aksi</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dp as $p):?>
                                                    <tr>
                                                        <td><?= $p['idPhotoVoucher'];?></td>
                                                        <td><?= "Rp. ". number_format($p['nominalVoucher'], 0, ',', '.')  ?></td>
                                                        <td>
                                                            <a href="<?= base_url('assets/img/photoVoucher/').$p['photoVoucher']?>" target="_blank"><img src="<?= base_url('assets/img/photoVoucher/').$p['photoVoucher']?>" style="width: 100px;height: 100px"></a>
                                                        </td>
                                                        <td align="center" valign="middle">
                                                            <a href="<?= base_url('Admin/h_setPrintVoucher/'.$p['idPhotoVoucher']) ?>" class="btn btn-danger mt-1" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>

                        <hr>

                    </div>
                </div>
            </div>
        </main>