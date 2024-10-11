<!-- Begin Page Content -->
<div class="container-fluid ">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">
            <?php 
                if($url_level == 1){    
                    echo "Master User Developer";
                }else if($url_level == 2){
                    echo "Master User Owner";
                }else if($url_level == 3){
                    echo "Master User Admin / Marketing";
                }

            ?>
            
            </h6>
            <?php if($url_level < 4){ ?>
                 <a data-toggle="modal" data-target="#modalAddUser" class="btn btn-sm btn-primary" href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
            <?php } ?>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>ID User</th>
                            <th>NIK</th>
                            <th>Angkatan</th>
                            <th>PIC/Reference</th>
                            <th>Email</th>
                            <th>Nama Lengkap/Usia</th>
                            <th>Handphone</th>
                            <th>Kampus/Semester</th>
                            <th>Status/Marketing</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $value) { ?>
                        <tr>
                            <td>
                               <!--  <a href="<?= base_url('P/Admin/edit_parameter/'.$value['id_user']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a> -->
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Admin/delete_user/').$value['id_user'];?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $value['id_user'];?></td>
                            <td><?= $value['nik'];?></td>
                            <td><?= $value['angkatan'];?></td>
                            <td><?= $value['pic'] ." - ". $value['reference'];?></td>
                            <td><?= $value['email'];?></td>
                            <td><?= $value['nama_lengkap'];?>-<?= $value['usia'];?></td>
                            <td>
                                <?= $value['handphone'];?>
                                <a href="<?= base_url('assets/p/img/'.$value['foto_ktp']);?>" target="blank">Foto KTP</a>
                            </td>
                            <td><?= $value['asal_kampus'];?>-<?= $value['semester'];?></td>
                            <td>
                                <?= $value['is_active'] == "Y" ? "Aktif" : "Tidak Aktif";?>/<?= $value['is_marketing'] == "Y" ? "Ya" : "Tidak";?>
                               
                            </td>
                            <td>
                                 <input type="password" id="password" class="password" disabled name="password" value="<?= $value['password'];?>">
                                 <input type="checkbox" id="togglePassword" class="togglePassword">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

 <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="user" action="<?= base_url('P/Admin/process_add_master_user/'.$url_level)?>" method="post">
                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 mt-3 mb-3 mb-sm-0">
                            <input type="number" class="form-control" required name="nik"
                                placeholder="NIK">
                        </div>
                        <div class="col-sm-12  mt-3 mb-3 mb-sm-0">
                            <input type="email" class="form-control" required name="email"
                                placeholder="Email">
                        </div>
                        <div class="col-sm-12  mt-3 mb-3 mb-sm-0">
                            <input type="text" class="form-control" required name="nama_lengkap"
                                placeholder="Nama Lengkap">
                        </div>
                        <div class="col-sm-12  mt-3 mb-3 mb-sm-0">
                            <input type="number" class="form-control" required name="handphone"
                                placeholder="Handphone">
                        </div> 
                        <div class="col-sm-12  mt-3 mb-3 mb-sm-0">
                            <input type="number" class="form-control" required name="usia"
                                placeholder="Usia">
                        </div>
                        <div class="col-sm-12  mt-3 mb-3 mb-sm-0">
                            <input type="text" class="form-control" required name="asal_kampus"
                                placeholder="Asal Kampus">
                        </div>
                        <div class="col-sm-12 mt-3 mb-3 mb-sm-0">
                            <select class="form-control" required name="semester">
                                <option value="" disabled selected>--Status Kuliah--</option>
                                <option value="1">Sudah Lulus</option>
                                <option value="0">Belum Lulus</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mt-3 mb-3 mb-sm-0">
                            <select class="form-control" required name="is_marketing">
                                <option value="" disabled selected>--Marketing--</option>
                                <option value="Y">Ya</option>
                                <option value="N">Tidak</option>
                            </select>
                        </div>
                        <div class="col-sm-12  mt-3 mb-3 mb-sm-0">
                            <input type="text" class="form-control" required name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Tambah User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        const togglePasswordCheckboxes = document.querySelectorAll('.togglePassword');

        togglePasswordCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const passwordInput = this.closest('tr').querySelector('.password');
                passwordInput.setAttribute('type', this.checked ? 'text' : 'password');
            });
        });

    </script>