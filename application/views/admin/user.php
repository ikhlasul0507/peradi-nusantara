         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data User Admin</li>
                    </ol>
                    <?php  if($this->session->flashdata('pesan')): ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?= $this->session->flashdata('pesan');?></strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php  endif; ?>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data User</div>
                    <div class="card-body">
                        <!-- kontek -->
                         <a href="<?= base_url('Admin/t_a');?>" class="btn btn-danger mb-4">Tambah User</a>
                        <div class="dropdown">
                        <br>
                </div>

                <div class="table-responsive">
                    <?php echo 'User IP - '.$_SERVER['REMOTE_ADDR']; ?>
                    <form action="<?= base_url('Peserta/p_upload'); ?>" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <td>Email</td>
                                    <td>Password</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ps as $p):?>
                                    <tr>
                                        <td><?= $p['email'];?></td>
                                        <td>
                                            <?php
                                            if($p['email'] == "amal@gmail.com"){
                                                echo "***********";
                                            }else{
                                                echo $p['password']; 
                                            }    
                                            ?>
                                        </td>    
                                        <td>
                                            <?php  if($p['email'] == $this->session->userdata('email')){
                                                echo   "ADMIN FULL";
                                            }else{    
                                                ?>
                                                <a href="<?= base_url('Admin/h_a/'.$p['id_a']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus ?')">Hapus</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>

                    <table border="1" style="width: 100%;font-size: 11px">
                        <tr><b>
                            <td>Waktu Login</td>
                            <td>Username</td>
                            <td>IP Address</td>
                            <td>Mac Address</td>
                            <td>Action</td>
                            <td>Browser Name</td>
                            </b>
                        </tr>
                         <?php 
                        $usersData = $this->db->query("SELECT * FROM tbl_history ORDER BY timeHistory DESC")->result_array();
                        foreach ($usersData as $key) :
                           ?>
                        <tr>
                            <td><?= $key['timeHistory'];?></td>
                            <td><?= $key['username'];?></td>
                            <td><?= $key['ipaddress'];?></td>
                            <td><?= $key['macaddress'];?></td>
                            <td style="background-color: <?php if($key['action'] == 0){echo "red";}else{echo "yellow";};?>"><?php if($key['action'] == 0){echo "Logout";}else{echo "Login";};?></td>
                            <td><?= $key['browser'];?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>