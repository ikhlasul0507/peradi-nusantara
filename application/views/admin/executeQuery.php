         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Execute Query</li>
                        </ol>
                       <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php  endif; ?>
                        <div class="row">
                        <div class="card col-6 mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Execute Query</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <form action="<?= base_url('Admin/p_executeQuery'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                        <div class="col-12">
                                            <label>Write Query</label>
                                            <textarea type="text" rows="5" cols="4" name="query" placeholder="Write Query" class="form form-control"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary mt-3">Execute Query</button>
                                            <button type="reset" class="btn btn-danger mt-3 ml-2">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card col-6 mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>list Table</div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <?php 
                                        $tables = $this->db->list_tables();
                                            foreach ($tables as $table)
                                            {
                                                    echo $table."</br>";
                                            }
                                    ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </main>