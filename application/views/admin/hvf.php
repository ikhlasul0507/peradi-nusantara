         <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <ol class="breadcrumb mb-4 mt-2">
                            <li class="breadcrumb-item active">Data Hasil Voting Finalis</li>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Hasil Voting Bujang</div>
                            <div class="card-body">
                                <div class="container">
                        
                        <canvas id="myChart"></canvas>
                    </div>
                    <?php 
                        $nama= "";
                        $jumlah=null;

                         $aaaaa = $this->db->query("SELECT * FROM tbl_set")->row_array();
                        $re = $aaaaa['set_web'];
                        if($re==1){
                          $a = $this->db->query("SELECT nvt,jr_vt, SUM(nmvt) AS Total FROM tbl_vt1 WHERE jk_v=1 GROUP BY nvt ORDER BY Total DESC")->result_array();
                          $at = $this->db->query("SELECT SUM(nmvt) AS tall FROM tbl_vt1 WHERE jk_v=1")->result_array();
                        }else{ 
                          $a = $this->db->query("SELECT nvt,jr_vt, SUM(nmvt) AS Total FROM tbl_vt1 WHERE jk_v=1 GROUP BY nvt ORDER BY Total DESC")->result_array();
                          $at = $this->db->query("SELECT SUM(nmvt) AS tall FROM tbl_vt1 WHERE jk_v=1")->result_array();
                        }
                        $ta = $at[0]['tall'];
                        
                        foreach ($a as $b) {
                            $jur=$b['nvt'];
                            $jr = $b['jr_vt'];
                            $nama .= "'$jur'". ", ";
                            //Mengambil nilai total dari database
                            $jum=substr($b['Total']*100/$ta, 0,4);
                            $jumlah .= "$jum". ", ";
                        }
                        
                     ?>
                        <script>
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    // The type of chart we want to create

                                    type: 'horizontalBar',
                                    // The data for our dataset
                                    data: {
                                        labels: [<?php echo $nama; ?>],
                                        datasets: [{
                                            label:'Persentase (%)',
                                            backgroundColor: "#3e95cd",
                                            borderColor: ['rgb(255, 99, 132)'],
                                            data: [<?php echo $jumlah; ?>]
                                        }]
                                    },


                                    // Configuration options go here
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero:true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>   
                                <!-- kontek -->
                                <hr>
                                <h3 class="center">Hasil Vote Bujang</h3>
                                <div class="table-responsive">
                                    
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr style="background-color: silver">
                                                <td>Nama Peserta</td>
                                                <td>Jurusan</td>
                                                <td>Presentasi</td>
                                                <td>Nominal</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($a as $b) { ?>
                                                <tr>
                                                <td><?= $b['nvt']; ?></td>
                                                <td><?= $b['jr_vt']; ?></td>
                                                <td><?= substr($b['Total']*100/$ta, 0,4);?>% </td>
                                                <td><?= "Rp. ". number_format($b['Total'], 0, ',', '.')  ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr style="background-color: silver">
                                                <td colspan="2"><b>Total</b></td>
                                                <td><b>100 %</b></td>
                                                <td><b><?= "Rp. ". number_format($ta, 0, ',', '.')  ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                             <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Hasil Voting Gadis</div>
                            <div class="card-body">
                                <div class="container">
                        
                        <canvas id="myChartg"></canvas>
                    </div>
                    <?php 
                        $namag= "";
                        $jumlahg=null;

                        $ag = $this->db->query("SELECT nvt,jr_vt, SUM(nmvt) AS Totalg FROM tbl_vt1 WHERE jk_v=2 GROUP BY nvt ORDER BY Totalg DESC")->result_array();
                        $atg = $this->db->query("SELECT SUM(nmvt) AS tall FROM tbl_vt1 WHERE jk_v=2")->result_array();
                        $tag = $atg[0]['tall'];
                        
                        
                        foreach ($ag as $bg) {
                            $jurg=$bg['nvt'];
                            $jrg = $bg['jr_vt'];
                            $namag .= "'$jurg'". ", ";
                            //Mengambil nilai total dari database

                            $jumg=substr($bg['Totalg']*100/$tag, 0,4);
                            $jumlahg .= "$jumg". ", ";
                        }
                        
                     ?>
                        <script>
                                var ctx = document.getElementById('myChartg').getContext('2d');
                                var chart = new Chart(ctx, {
                                    // The type of chart we want to create
                                    type: 'horizontalBar',
                                    // The data for our dataset
                                    data: {
                                        labels: [<?php echo $namag; ?>],
                                        datasets: [{
                                            label:'Persentase (%)',
                                            backgroundColor: "#c45850",
                                            borderColor: ['rgb(255, 99, 132)'],
                                            data: [<?php echo $jumlahg; ?>]
                                        }]
                                    },

                                    // Configuration options go here
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero:true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>   
                                <!-- kontek -->
                                <hr>
                                <h3 class="center">Hasil Vote Gadis</h3>
                                <div class="table-responsive">
                                    
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                        <thead>
                                            <tr style="background-color: silver">
                                                <td>Nama Peserta</td>
                                                <td>Jurusan</td>
                                                <td>Presentasi</td>
                                                <td>Nominal</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ag as $bg) { ?>
                                                <tr>
                                                <td><?= $bg['nvt']; ?></td>
                                                <td><?= $bg['jr_vt']; ?></td>
                                                <td><?= substr($bg['Totalg']*100/$tag, 0,4);?>%</td>
                                                <td><?= "Rp. ". number_format($bg['Totalg'], 0, ',', '.')  ?></td>
                                                </tr>
                                            <?php } ?>
                                             <tr style="background-color: silver">
                                                <td colspan="2"><b>Total</b></td>
                                                <td><b>100 %</b></td>
                                                <td><b><?= "Rp. ". number_format($tag, 0, ',', '.')  ?></b></td>
                                            </tr>
                                            <tr style="background-color: red;color: white">
                                                <td colspan="3"><b>Total Keseluruhan Finalis</b></td>
                                               
                                                <td><b><?= "Rp. ". number_format($tag+$ta, 0, ',', '.')  ?></b></td>
                                            </tr>
                                           <!--  <?php 
                                            $tsf = $this->db->query("SELECT SUM(nmvt) as Totals FROM tbl_vt1")->row_array();
                                            $tSemi = $tsf['Totals']; 
                                             ?>
                                            <tr style="background-color: blue;color: white">
                                                <td colspan="3"><b>Total Keseluruhan Semi Finalis</b></td>
                                               
                                                <td><b><?= "Rp. ". number_format($tSemi, 0, ',', '.')  ?></b></td>
                                            </tr> -->
                                            <?php 
                                            $tsf = $this->db->query("SELECT SUM(nmvt) as Totals FROM tbl_vt1")->row_array();
                                            $tPeny = $tsf['Totals']; 
                                             ?>
                                           <!--  <tr style="background-color: yellow;color: black">
                                                <td colspan="3"><b>Total Keseluruhan Penyisihan</b></td>
                                               
                                                <td><b><?= "Rp. ". number_format($tPeny, 0, ',', '.')  ?></b></td>
                                            </tr> -->
                                            <tr style="background-color: green;color: white">
                                                <td colspan="3"><b>Total Keseluruhan Voting</b></td>
                                               
                                                <td><b><?= "Rp. ". number_format($tag+$ta+$tPeny, 0, ',', '.')  ?></b></td>
                                            </tr>
                                            <!-- <tr style="background-color: grey;color: white">
                                                <td colspan="3"><b>Total 20 %</b></td>
                                               
                                                <td><b><?= "Rp. ". number_format(($tSemi+$tag+$ta+$tPeny)*0.20, 0, ',', '.')  ?></b></td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>