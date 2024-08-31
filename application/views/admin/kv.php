         <div id="layoutSidenav_content">
          <main>
            <div class="container-fluid">
              <ol class="breadcrumb mb-4 mt-2">
                <li class="breadcrumb-item active">Kode Voucher</li>
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
            <?php
            $re = $activeGenerateVoucher;
            if($re==1){
             ?>
             <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Generate Voucher
              </button>
               <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#exampleModalImport">
                Import Voucher
              </button>
              <a type="button" class="btn btn-danger mb-3" href="<?= base_url('Admin/exportVoucher');?>">
                Export Voucher
              </a>
           <?php }?>

          

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Generate Voucher</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="<?= base_url('Admin/gvc');?>">
                        <div class="form-group">
                         <label for="exampleFormControlSelect1">Pilih Nominal</label>
                         <select class="form-control" id="exampleFormControlSelect1" name="nm">
                          <option selected disabled>Pilih Nominal</option>
                           <?php
                            $val = $optionsNominalVoucher;
                            $arrayString= explode(",", $val);
                            for ($i=0; $i <  count($arrayString); $i++) {?>
                              <option value="<?= $arrayString[$i];?>"><?="Rp. ". number_format($arrayString[$i], 0, ',', '.');?></option>
                            <?php } ?>
                         </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Jumlah" name="jm">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                      </div>
            
                     <button type="submit" class="btn btn-primary">Generate</button> 
                    </form>
                  </div>
                </div>
              </div>
            </div><br>

            <!-- Modal -->
              <div class="modal fade" id="exampleModalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Import Voucher</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="<?= base_url('Admin/processImportVoucher');?>"  enctype="multipart/form-data">
                 
                      <div class="form-group">
                        <label for="exampleInputPassword1">Notes : Type File Excel (.csv)</label>
                        <input type="file" class="form-control" id="exampleInputPassword1" accept="text/csv" placeholder="Jumlah" required name="nameFile">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                      </div>
                    
                     <button type="submit" class="btn btn-primary" name="import">Process</button> 
                    </form>
                  </div>
                </div>
              </div>
            </div><br>
          <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Voucher Per Page : <?= $dataVJ; ?>  <?php
          $em = $this->session->userdata('email');
          if($em=="amal@gmail.com"){ ?> || <a href="<?= base_url('admin/deleteAllVoucher');?>">Delete All</a>
        <?php } ?>
        </div>

            <div class="card-body">
              <!-- kontek -->
              <div class="table-responsive">
                <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                  <table id="dataTable" border="1px" width="100%" cellspacing="0">
                    
                    <thead>
                      <tr style="background-color: blue">
                        <td>ID Voucher</td>
                        <td>Kode Voucher</td>
                        <td>Nominal</td>
                        <td>Aksi</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($kv as $p):?>
                        <tr>
                          <td><?= $p['id_vc'];?></td>
                          <td>
                            <?php if($p['st_vc'] == 1){?>
                              <button class="badge badge-danger">Sold Out</button>
                           <?php } ?>
                            <?= $p['kv'];?>

                          </td>
                          <td><?= "Rp. ". number_format($p['nmv'], 0, ',', '.')  ?></td>
                          <td><a href="<?= base_url('Admin/hvc/'.$p['id_vc'])?>" >Hapus</a></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </form>
              </div>
     <!--          <style type="text/css">
                .pagination {
                    font-size: 20px;
                    align-content: center;
                }
                .pagination li {
                    color: black;
                    float: left;
                    padding: 8px 16px;
                    text-decoration: none;
                    border : 1px solid black;
                    background-color: #cfcfcf
                  }

                  .pagination li.active {
                    background-color: black;
                    color: white;
                  }

                  .pagination li:hover:not(.active) {
                    background-color: #ffc107;
                  }
              </style>
              <nav aria-label="Page navigation" class="mt-3">
                          <?php 
              echo $this->pagination->create_links();
              ?>

              </nav> -->
            </div>
          </div>
        </div>
      </main>