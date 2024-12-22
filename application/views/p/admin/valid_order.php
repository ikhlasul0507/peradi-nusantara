
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?= $previous_url;?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        <?php if (strpos($list_kelas_data['is_sumpah'], "Y") !== false) {?>
            <a href="<?= base_url('P/Admin/uploadBerkasSumpah/'.$value['id_user'].'/'.$value['id_order_booking']);?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Upload Berkas Sumpah</a>
        <?php } ?>
        <?php if($this->session->userdata('user_level') <= 3 && $value['status_certificate'] == 'A'){ ?>
               <a href="<?= base_url('P/Admin/add_master_product');?>" data-toggle="modal" data-target="#modalKTA" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-book fa-sm text-white-50"></i> Terbitkan KTA</a>  
        <?php } ?>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><button class="btn btn-danger" disabled><?= $list_kelas_data['nama_kelas'];?></button></h6>
                    <?php if($this->session->userdata('user_level') <= 3){ 
                        if($value['is_paid'] == 'N'){ ?>
                            <img class="img-fluid" style="width: 10rem; height: 5rem"
                                src="<?= base_url('assets/p/img/cap-unpaid.jpg');?>" alt="...">
                        <?php }else{ ?>
                            <img class="img-fluid" style="width: 10rem; height: 5rem"
                                src="<?= base_url('assets/p/img/paid_order.jpg');?>" alt="...">
                    <?php }} ?>
                </div>
                <form action="<?= base_url('P/Admin/process_valid_order')?>" method="post">
                    <input type="hidden" name="nama_kelas" value="<?= $list_kelas_data['nama_kelas'];?>">
                    <div class="card-body">
                        <div class="text-center">
                            <a href="<?= base_url('assets/p/img/'.$value['foto_ktp']);?>" target="blank">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; height: 10rem"
                                src="<?= base_url('assets/p/img/'.$value['foto_ktp']);?>" alt="...">
                            </a>
                        </div>
                        <p>
                            Waktu Order :  <?= $value['time_history'];?><br>
                            Nama :  <?= $value['nama_lengkap'];?><br>
                            Handphone :  <?= $value['handphone'];?><br>
                            Status Peserta :  <?= $value['is_new_user'] == "Y" ? "Peserta Baru" : "Pindahan";?><br>
                            Metode Pembayaran : <button class="badge badge-primary" disabled><?= $value['metode_bayar'];?></button>
                            <?php if($value['status_order'] == 'N'){ ?>
                                <select name="metode_bayar" required>
                                    <option value="" disabled selected>--Pilih Metode--</option>
                                    <?php 
                                    $tahapBayar = explode(",", "Lunas, Bertahap, Cicilan");
                                    foreach ($tahapBayar as $t) { ?>
                                    <option value="<?= $t; ?>"><?= $t; ?></option>
                                    <?php } ?>
                                </select>
                            <?php }?>
                            <br>
                            Referensi :  <?= $value['reference'];?><br>
                            PIC :  <?= $value['pic'];?>
                            <?php if($value['status_order'] == 'N'){ ?>
                                <select name="pic" required>
                                    <option value="" disabled selected>--Pilih PIC--</option>
                                    <?php foreach ($list_pic as $pic) { ?>
                                        <option value="<?=$pic;?>"><?=$pic;?></option>
                                    <?php } ?>
                                </select>
                            <?php }?>
                            <hr>
                            <?php 
                            $tahapBayar = explode(",", $list_kelas_data['nama_kelas']);
                            $idmasterkelas = explode(",", $list_kelas_data['id_master_kelas']);
                            $idx = 0;
                            foreach ($tahapBayar as $t) { ?>
                                <?php if($value['angkatan_kelas'] == ""){ ?>
                                Angkatan-(<?=$t;?>) : 
                                <?php if($value['status_order'] == "N"){ ?>
                                <select name="angkatan_<?=str_replace(' ', '', $t);?>" required>
                                    <option value="" disabled selected>--Pilih Angkatan--</option>
                                   <?php for ($i=$startAngkatan; $i <= $endAngkatan; $i++) { ?>
                                        <option value="<?= 'angkatan-'.$i;?>"><?= 'Angkatan-'.$i;?></option>
                                    <?php } ?>
                                </select>
                                <?php }else{
                                    echo $value['angkatan'];
                                } ?>
                                <?php }else{ 
                                    echo "(".$t.") : ";
                                    $arrAngkatan = explode("~", $value['angkatan_kelas']);
                                    $angkaAng = explode("-", ucfirst($arrAngkatan[$idx]));
                                    echo ucfirst($arrAngkatan[$idx]);
                                    echo '--<a href="'.base_url('P/Admin/bukaKelas/').$angkaAng[1].'/'.$idmasterkelas[$idx].'" class="badge badge-danger" >Buka Jadwal Kelas</a>';
                                } ?>
                            </br>
                            <?php $idx++;} ?>
                            <hr>
                            <?php if($this->session->userdata('user_level') <= 3 && $value['status_certificate'] == 'A'){ 
                                foreach ($list_kta as $lk) {
                                switch ($lk['jenis_kta']) {
                                    case 1:
                                        $txt = "Cetak KTA Advokat";
                                        break;
                                    case 2:
                                        $txt = "Cetak KTA Paralegal";
                                        break;
                                    case 4:
                                        $txt = "Cetak KTA Pajak";
                                        break;
                                    default:
                                        // code...
                                        break;
                                }
                                ?>
                                <a  class="btn btn-sm btn-danger" target="_blank" href="<?= base_url('P/Admin/generateKTA/'.$value['id_user'].'/'.$lk['id_kta']);?>"><?= $txt; ?></a>
                            <?php }}?>
                        </p>
                        <?php if($value['status_order'] == 'N'){ ?>
                            <!-- <a  class="btn btn-sm btn-warning" href="<?= base_url('P/Admin/process_valid_order/'.$value['id_user'].'/'.$value['id_order_booking']);?>">Validasi Order</a> -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                            <input type="hidden" name="id_user" value="<?= $value['id_user']; ?>">
                            <input type="hidden" name="id_order_booking" value="<?= $value['id_order_booking']; ?>">
                            <button class="btn btn-sm btn-warning" type="submit">Validasi Order</button>

                        <?php }else if($value['status_order'] == 'L'){ ?>
                            <button class="btn btn-sm btn-primary" href="#" disabled>Sedang Belajar</button>
                        <?php }elseif($value['status_order'] == 'D'){?>
                            <button class="btn btn-sm btn-success" href="#" disabled>Selesai Belajar</button>
                            <a  class="btn btn-sm btn-primary" target="blank" href="<?= base_url('P/Payment/createInvoice/'.$value['id_order_booking']);?>">Cetak Invoice</a>
                        <?php } ?>
                        <?php if($value['status_order'] == 'D' && $value['status_certificate'] == 'A' && $list_kelas_data['nama_kelas'] != 'SUMPAH'){ ?>
                            <a  class="btn btn-sm btn-warning" target="blank" href="<?= base_url('P/Payment/generateCertificate/'.$value['id_user'].'/'.$value['id_order_booking']);?>">Ambil Sertifikat</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7 mb-4">
            <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
                <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
                <?php if($value['status_order'] == 'L'){ ?>
                 <a href="<?= base_url('P/Admin/add_master_product');?>" data-toggle="modal" data-target="#modalAdd" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
                <?php } ?>
            </div>
             <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sequence</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        $lunas = 0;
                        $blunas = 0;
                        foreach ($orderPayment as $op) { 
                        $total += (int) $op['nominal_payment'];
                        if($op['status_payment'] == 'P'){
                            $blunas++;
                        }else{
                            $lunas++;
                        }
                        ?>
                        <tr>
                            <td><?= $op['sequence_payment'];?></td>
                            <td><?= $op['date_payment'];?></td>
                            <td><?= 'Rp ' . number_format($op['nominal_payment'], 0, ',', '.');?></td>
                            <td>
                                <?php 
                                $btnDel = "";
                                if($op['status_payment'] == 'P'){
                                    echo '<button class="badge badge-primary" disabled>Belum Lunas</button>';
                                }else if($op['status_payment'] == 'D'){
                                    echo '<button class="badge badge-success" disabled>Sudah Lunas</button>';
                                }

                                ?>
                                <a target="blank" href="<?= base_url('P/Payment/virtual_account/'.$op['id_virtual_account']);?>" class="btn btn-success btn-circle">
                                    <i class="fas fa-credit-card"></i>
                                </a>

                                <?php  if($op['status_payment'] == 'P'){ ?>
                                <a class="btn btn-danger btn-circle" onclick="confirmDeleteData('<?= base_url('P/Admin/delete_order_payment/'.$value['id_user'].'/'.$op['id_order_payment']);?>')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php } ?>
                                <?php  if($op['status_payment'] == 'G'){
                                    echo '<button class="badge badge-warning" disabled>Sudah Generate</button>';
                                }?>

                              
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total Pembayaran</th>
                            <th><?= 'Rp ' . number_format($total, 0, ',', '.');?></th>
                            <th><?= "L = ".$lunas.", BL = ".$blunas; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="modalKTA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="user" action="<?= base_url('P/Admin/process_add_kta')?>" method="post">
                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terbitkan KTA</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="id_user" value="<?= $value['id_user']; ?>">
                            <input type="hidden" name="id_order_booking" value="<?= $value['id_order_booking']; ?>">
                            <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                                 <select class="form-control" required name="jenis_kta">
                                        <option value="" disabled selected>--Jenis KTA--</option>
                                        <option value="4">PAJAK</option>
                                        <option value="2">PARALEGAL</option>
                                        <option value="1">ADVOKAT</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                                <input type="text" class="form-control" required name="nama_kta"
                                    placeholder="Nama Lengkap">
                            </div>
                            <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                                <label>Berlaku s/d KTA</label>
                                <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" required name="berlaku_kta"
                                    placeholder="Date Payment">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
     <script>
        const rupiahInput = document.getElementById('rupiah');

        rupiahInput.addEventListener('keyup', function(e) {
            // Format number to Rupiah
            let value = this.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            this.value = 'Rp ' + rupiah;
        });
    </script>
            
<?php if($value['status_order'] == 'L'){ ?>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="user" action="<?= base_url('P/Admin/process_add_order_payment')?>" method="post">
                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="id_user" value="<?= $value['id_user']; ?>">
                            <input type="hidden" name="id_order_booking" value="<?= $value['id_order_booking']; ?>">
                            <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                                <input type="hidden" name="sequence_payment" value="<?= $sequenceNumber['sequence_payment']; ?>">
                                <input type="number" class="form-control" value="<?= $sequenceNumber['sequence_payment']; ?>" disabled>
                            </div>
                            <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                                <input type="text" id="rupiah" class="form-control" required name="nominal_payment"
                                    placeholder="Nominal Payment">
                            </div>
                            <div class="col-sm-12 mb-3 mt-2 mb-sm-0">
                                <label>Tanggal Bayar</label>
                                <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" required name="date_payment"
                                    placeholder="Date Payment">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
     <script>
        const rupiahInput = document.getElementById('rupiah');

        rupiahInput.addEventListener('keyup', function(e) {
            // Format number to Rupiah
            let value = this.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            this.value = 'Rp ' + rupiah;
        });
    </script>
            