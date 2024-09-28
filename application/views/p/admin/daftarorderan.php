
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelas Belajar</h1>
       
    </div>

    <!-- Content Row -->
     <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Detail Orderan</th>
                            <th>Data</th>
                            <th>Status Orderan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Aksi</th>
                            <th>Detail Orderan</th>
                            <th>Data</th>
                             <th>Status Orderan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list_data as $value) { 
                            $array = explode("~", $value['list_kelas']);
                            $array = array_filter($array, function($value) {
                                return $value !== '';
                            });
                            $inClause = implode(",", $array);
                            $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
                            $getListKelas = $this->db->query($query)->row_array();
                            $idBook = $value['id_order_booking'];
                            $query1 = "SELECT COUNT(id_order_payment) countData FROM order_payment WHERE id_order_booking = '$idBook' AND status_payment = 'D'";
                            $getOP = $this->db->query($query1)->row_array();
                            ?>
                        <tr>
                            <td>
                                <?php if(((int) $getOP['countData']) == 0){ ?>
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Admin/delete_order_class/').$value['id_order_booking'];?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php } ?>
                                <a href="<?= base_url('P/Admin/valid_order/'.$value['id_user'].'/'.$value['id_order_booking']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-info"></i>
                                </a> Lihat Detail
                            </td>
                            <td>
                                Waktu Order :  <?= $value['time_history'];?><br>
                                Nama :  <?= $value['nama_lengkap'];?><br>
                                Handphone :  <?= $value['handphone'];?><br>
                                Kelas :  <button class="badge badge-danger" disabled><?= $getListKelas['nama_kelas'];?></button><button class="badge badge-primary" disabled><?= $value['metode_bayar'];?></button>

                            </td>
                            <td>
                                Referensi : <?= $value['reference'];?><br>
                                PIC : <?= $value['pic'];?><br>
                                Angkatan : <?= $value['angkatan'];?><br>
                            </td>
                            <td>
                                <button class="badge badge-primary" disabled>Belum Lunas</button><br>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>
<!-- /.container-fluid -->

            