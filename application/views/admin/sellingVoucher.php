         <div id="layoutSidenav_content">
          <main>
            <div class="container-fluid">
              <ol class="breadcrumb mb-4 mt-2">
                <li class="breadcrumb-item active">Selling Voucher</li>
              </ol>
              <?php  if($this->session->flashdata('pesan')): ?>   
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><?= $this->session->flashdata('pesan');?></strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php  endif; ?>
              <!-- Button trigger modal -->
          <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Selling Voucher</div>

            <div class="card-body">
              <!-- kontek -->
              <div class="table-responsive">
                <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                      <tr style="background-color: blue">
                        <td>ID Selling VC</td>
                        <td>Nominal Voucher</td>
                        <td>Biodata</td>
                        <td>Transfer Evidence</td>
                        <td>Buying Date</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($sellingVoucher as $p):?>
                        <tr>
                          <td><?= $p['idSellingVoucher'];?></td>
                          <td>
                            <?= "Rp. ". number_format($p['nominalVoucher'], 0, ',', '.')  ?>
                            <br>
                            Voucher Code : <?= $p['kodeVoucher'];?>
                          </td>
                          <td>
                            <?= $p['nama'];?>
                            <br>
                            <?= $p['handphone'];?>
                            <br>
                            <?php if($p['statusVoucher'] == 1){ ?>
                            <a target="blank" href="https://wa.me/62<?= $p['handphone'];?>/?text=Halo !%0ASaya Admin Putera Puteri Sriwijaya%0APembelian Voucher Anda Berhasil !%0A----------------------------%0ANama : %20<?= $p['nama'];?>%0AKode Voucher :%20_*<?= $p['kodeVoucher'];?>*_%20%0ANominal : %20<?= "Rp. ". number_format($p['nominalVoucher'], 0, ',', '.')  ?>%0ATanggal Pembelian : %20<?= $p['dateCreated'];?>%0A----------------------------%0A%20_***Voucher Hanya Berlaku 1 kali*_%20">Send To Whatsapp</a>
                            <?php }else if($p['statusVoucher'] == 2){
                              echo "%--Voucher Expired--%";
                            } ?>
                          </td>
                          <td>
                            <a href="<?= base_url('assets/img/sellingVoucher/').$p['buktitransfer']?>" target="_blank"><img src="<?= base_url('assets/img/sellingVoucher/').$p['buktitransfer']?>" style="width: 100px;height: 100px"></a>
                            <?php if($p['statusVoucher'] == 0){ ?>
                            <a href="<?= base_url('admin/verifySellingVoucher/'.$p['idSellingVoucher']);?>">Verify</a>
                            <?php } ?>
                          </td>
                          <td><?= $p['dateCreated'];?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>