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
                        <div >

                            <canvas id="myChart" style="height: 100vh"></canvas>
                        </div>
                        <?php 
                        $nama= "";
                        $jumlah=null;

                        $a = $this->db->query("SELECT nvt,jr_vt, SUM(nmvt) AS Total FROM tbl_vt4 WHERE jk_v=1 GROUP BY nvt ORDER BY Total DESC")->result_array();
                        $at = $this->db->query("SELECT SUM(nmvt) AS tall FROM tbl_vt4 WHERE jk_v=1")->result_array();
                        
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
                                        },

                                        responsive: true,
                                        maintainAspectRatio: false
                                    }
                                });
                            </script>   
                            <!-- kontek -->
                            <hr>
                            <h3 class="center">Hasil Vote Bujang</h3>
                            <div class="table-responsive">

                               <table id="" border="1px" width="100%" cellspacing="0">

                                <thead>
                                    <tr style="background-color: silver">
                                        <td>Nama Peserta</td>
                                        <td>Presentasi</td>
                                        <td>Nominal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($a as $b) { ?>
                                        <tr>
                                            <td><?= $b['nvt']; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <?= substr($b['Total']*100/$ta, 0,4);?>% 
                                                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: <?= substr($b['Total']*100/$ta, 0,4);?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= substr($b['Total']*100/$ta, 0,4);?>%</div>
                                                </div>
                                            </td>
                                            <td><?= "Rp. ". number_format($b['Total'], 0, ',', '.')  ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background-color: silver">
                                        <td colspan="1"><b>Total</b></td>
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
                        <div>

                            <canvas id="myChartg" style="height: 100vh"></canvas>
                        </div>
                        <?php 
                        $namag= "";
                        $jumlahg=null;

                        $ag = $this->db->query("SELECT nvt,jr_vt, SUM(nmvt) AS Totalg FROM tbl_vt4 WHERE jk_v=2 GROUP BY nvt ORDER BY Totalg DESC")->result_array();
                        $atg = $this->db->query("SELECT SUM(nmvt) AS tall FROM tbl_vt4 WHERE jk_v=2")->result_array();
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
                                        },
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }
                                });
                            </script>   
                            <!-- kontek -->
                            <hr>
                            <h3 class="center">Hasil Vote Gadis</h3>
                            <div class="table-responsive">

                               <table id="" border="1px" width="100%" cellspacing="0">

                                <thead>
                                    <tr style="background-color: silver">
                                        <td>Nama Peserta</td>
                                        <td>Presentasi</td>
                                        <td>Nominal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ag as $bg) { ?>
                                        <tr>
                                            <td><?= $bg['nvt']; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <?= substr($bg['Totalg']*100/$tag, 0,4);?>%
                                                    <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: <?= substr($bg['Totalg']*100/$tag, 0,4);?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= substr($bg['Totalg']*100/$tag, 0,4);?>%</div>
                                                </div>
                                            </td>
                                            <td><?= "Rp. ". number_format($bg['Totalg'], 0, ',', '.')  ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background-color: silver">
                                        <td colspan="1"><b>Total</b></td>
                                        <td><b>100 %</b></td>
                                        <td><b><?= "Rp. ". number_format($tag, 0, ',', '.')  ?></b></td>
                                    </tr>

                                </tbody>
                            </table>
                            <table id="" border="1px" width="100%" class="mt-3" cellspacing="0">
                            <tr style="background-color: black;color: white">
                                <td colspan="2"><b>Total Keseluruhan </b></td>

                                <td><b><?= "Rp. ". number_format($tag+$ta, 0, ',', '.')  ?></b></td>
                            </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </main>