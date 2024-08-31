         <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-4 mt-2">
                        <li class="breadcrumb-item active">Data Rekap Hasil Voting </li>
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
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Rekap Hasil Voting</div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tbody>
                                   <tr style="background-color: silver">
                                    <td>Tahapan Voting</td>
                                    <td>Total Nominal</td>
                                        </tr>
                                        <?php 
                                        $usersData = $this->db->query("SELECT * FROM tbl_menu WHERE isActive=1 AND idMenu <=5 ORDER BY idMenu ASC" )->result_array();
                                        $totalNilai = 0;
                                        foreach ($usersData as $key) :
                                         ?>
                                         <tr style="background-color: green;color: white">
                                            <td ><b><?= $key['namaMenu'];?></b></td>

                                            <td>
                                                <?php 
                                                $dataTabel = $key['namaTabel'];
                                                $tsf = $this->db->query("SELECT SUM(nmvt) as Totals FROM $dataTabel")->row_array();
                                                $tPeny = $tsf['Totals']; 
                                                $totalNilai = $totalNilai + $tPeny;
                                                echo "Rp. ". number_format($tPeny, 0, ',', '.');?>

                                            </td>
                                        </tr>


                                    <?php endforeach; ?>
                                    <tr style="background-color: red; color: white">
                                        <td>Total Keseluruhan</td>
                                        <td><b><?php echo "Rp. ". number_format($totalNilai, 0, ',', '.');?></b></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Data Rekap Hasil Voucher</div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tbody>
                                   <tr style="background-color: silver">
                                    <td>Tahapan Voting</td>
                                    <td>Total Nominal</td>
                                    </tr>
                                     <tr style="background-color: green;color: white">
                                        <td>Voucher Virtual</td>
                                        <td><?php
                                            $query = $this->db->query("SELECT SUM(totalBayar) as totalBayar FROM vouchermanual")->row_array();
                                            echo "Rp. ". number_format($query['totalBayar'], 0, ',', '.');
                                         ?></td>
                                    </tr>
                                    <tr style="background-color: green;color: white">
                                        <td>History Vote</td>
                                        <td><?php
                                            $query = $this->db->query("SELECT SUM(nominal) as nominal FROM history_voucher")->row_array();
                                            echo "Rp. ". number_format($query['nominal'], 0, ',', '.');
                                         ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

</main>