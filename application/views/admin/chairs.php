         <div id="layoutSidenav_content">
          <main>
            <div class="container-fluid">
              <ol class="breadcrumb mb-4 mt-2">
                <li class="breadcrumb-item active">List Of Chairs</li>
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
            $re = $activeGenerateChairs;
            if($re==1){
             ?>
             <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#exampleModalChairs">
                Generate Chairs Number
              </button>
           <?php }?>

                           <!-- Modal -->
              <div class="modal fade" id="exampleModalChairs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalChairs">Generate Chairs</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="<?= base_url('Admin/gchairs');?>">
                        <div class="form-group">
                         <label for="exampleFormControlSelect1">From Number</label>
                         <input type="number" class="form-control" id="fromNumber" placeholder="fromNumber" name="fromNumber">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Thru Number</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" placeholder="thruNumber" name="thruNumber">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                      </div>
            
                     <button type="submit" class="btn btn-primary">Generate</button> 
                    </form>
                  </div>
                </div>
              </div>
            </div><br>
          <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>List Of Chairs || <a href="<?= base_url('admin/deleteAllChairs');?>">Delete All</a></div>

            <div class="card-body">
              <!-- kontek -->
              <div class="table-responsive">

                <div class="row">
                  <?php 
                  $color = "";
                  $text = "";
                  foreach ($chairs as $value) { ?>
                   <?php if($value['st_kursi'] == 0){
                    $text =  "Ready";
                    $color = "bg-success";
                  }else{
                    $text =  "Sold Out";
                    $color = "bg-danger";
                  } ?>
                  <div class="col-2 mt-4">
                    <nav class="navbar <?= $color; ?>">
                      <div class="container-fluid">
                        <span class="navbar-text">
                         <b> <?= $value['noKursi'].'</b> ('.$text;?>)
                        </span>
                      </div>
                    </nav>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>