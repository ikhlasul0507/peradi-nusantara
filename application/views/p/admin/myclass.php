
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelas Ku</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <?php foreach ($list_data as $value) { 
            $status = "";
            $idData = $value['id_user'].'/'.$value['id_order_booking'];
            $colorPercent= "";
            $countPercent = 0;
            if($value['status_order'] == 'N'){
                $countPercent = 25;
                $colorPercent = "danger";
                $status = '<button class="btn btn-sm btn-danger" disabled>Proses Validasi Admin</button>';
            }else if($value['status_order'] == 'L'){
                $countPercent = 75;
                $colorPercent = "primary";
                $status = '<a class="btn btn-sm btn-primary" href="'.base_url("P/Admin/open_class/".$idData).'">Buka Kelas</a>';
            }else if($value['status_order'] == 'D'){
                $colorPercent = "success";
                $status = '<a class="btn btn-sm btn-primary" href="'.base_url("P/Admin/open_class/".$idData).'">Buka Kelas</a><a class="btn btn-sm btn-danger ml-2" target="blank" href="'.base_url('P/Payment/createInvoice/'.$value['id_order_booking']).'">Cetak Invoice</a>';
                $countPercent = 100;
            }
            if($value['status_order'] == 'D' && $value['status_certificate'] == 'A'){
                $status = $status.' <a target="blank"  class="btn btn-sm btn-warning"  href="'.base_url("P/Payment/generateCertificate/".$idData).'">Ambil Sertifikat</a>';
            }

            $array = explode("~", $value['list_kelas']);
            $array = array_filter($array, function($value) {
                return $value !== '';
            });
            $inClause = implode(",", $array);
            $query = "SELECT GROUP_CONCAT(nama_kelas)AS nama_kelas , foto_kelas  FROM master_kelas WHERE id_master_kelas IN ($inClause)";
            $getListKelas = $this->db->query($query)->row_array();
        ?>
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <?= $getListKelas['nama_kelas'];?>
                        </h6>
                </div>
                <div class="card-body">
                    <label>Progress Belajar</label>
                    <div class="progress">
                        <div class="progress-bar bg-<?= $colorPercent;?>" role="progressbar" style="width: <?= $countPercent.'%';?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $countPercent.'%';?></div>
                    </div>
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; height: 4rem"
                            src="<?= base_url('assets/p/img/'.$getListKelas['foto_kelas']);?>" alt="...">
                    </div>
                    <?= $status; ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>
<!-- /.container-fluid -->

            